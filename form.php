<?
header('Content-type:text/html; charset=utf-8');
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

//Настройка reCaptcha3
// $captcha;
// if(isset($formData["token"])) {
// 	$captcha = $formData["token"];
// }
// $secretKey = "6LdO2vwZAAAAABK_6XKs665LfIFzeK_xxcV_j-a-";
// $url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha;
// $response = file_get_contents($url);
// $responseKeys = json_decode($response, true);
// header("Content-type: application/json");
// if($responseKeys["success"] && $responseKeys["success"] >= 0.5) {
// 	echo json_encode(array("success" => "true", "om_score" => $responseKeys["score"], "token" => $formData["token"]));
// } else {
// 	echo json_encode(array("success" => "false", "om_score" => $responseKeys["score"], "token" => $formData["token"]));
// }

$formData = json_decode(file_get_contents("php://input"), true);

if($formData) {
	$name = stripslashes($formData["name"]);
	$phone = stripslashes($formData["phone"]);
	$email = stripslashes($formData["email"]);
	$message = stripslashes($formData["message"]);
	$files = $formData["files"];
	$emailTo = decrypt(stripslashes($formData["emailto"]), 'qwTYrSQ*&%0asdfasfCDSVGDgeq~de1QcvSde*&34|\.ddf');

	//Настройка reCaptcha3
	$captcha = $formData["token"];
	$secretKey = "6LdO2vwZAAAAABK_6XKs665LfIFzeK_xxcV_j-a-";
	$url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha;
	$response = file_get_contents($url);
	$responseKeys = json_decode($response, true);
	header("Content-type: application/json");
	//pr($responseKeys);
	// if($responseKeys["success"] && $responseKeys["score"] >= 0.5) {
	// 	echo json_encode(array("success" => "true", "om_score" => $responseKeys["score"], "token" => $formData["token"]));
	// } else {
	// 	echo json_encode(array("success" => "false", "om_score" => $responseKeys["score"], "token" => $formData["token"]));
	// }

	// $masternachas = stripslashes($formData["masternachas"]);
	// $santehnik = stripslashes($formData["santehnik"]);
	// $elektrik = stripslashes($formData["elektrik"]);
	// $mebel = stripslashes($formData["mebel"]);
	// $remont = stripslashes($formData["remont"]);
	// $rbt = stripslashes($formData["rbt"]);
	// $dveri = stripslashes($formData["dveri"]);
	// $svarka = stripslashes($formData["svarka"]);


	CModule::IncludeModule('iblock'); 
	$el = new CIBlockElement;

	$PROP = array();
	$PROP["NAME"] = $name;
	$PROP["PHONE"] = $phone;
    $PROP["EMAIL"] = $email;

	$arLoadProductArray = Array(
	  "MODIFIED_BY"    => $USER->GetID(),// элемент изменен текущим пользователем
	  "IBLOCK_SECTION_ID" => false,// элемент лежит в корне раздела
	  "IBLOCK_ID"      => 32,
	  "PROPERTY_VALUES"=> $PROP,
	  "NAME"           => "Заявка",
	  "ACTIVE"         => "Y",// активен
	  "DETAIL_TEXT"    => $message,
	  // "DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/image.gif")
	  );

	// if($PRODUCT_ID = $el->Add($arLoadProductArray))
	//   echo "New ID: ".$PRODUCT_ID;
	// else
	//   echo "Error: ".$el->LAST_ERROR;


	$subject = "Письмо с сайта https://in-news.ru";
	$message.= "<br>Телефон: ".$phone;
	$headers = "Content-type: text/html; charset=utf-8 \r\n";
	$headers .= "From: <".$email.">\r\n";

	$mail = mail($emailTo, $subject, $message, $headers);

	if(	
		$mail 
		and $PRODUCT_ID = $el->Add($arLoadProductArray) 
		//and $responseKeys["success"] 
		//and $responseKeys["score"] >= 0.5 
	) {
		echo "Ваша заявка успешно отправлена, мы свяжемся с вами в близжайшее время";
	} else {
		echo "Произошел сбой, ваша заявка не отправлена";
	}
}


?>
