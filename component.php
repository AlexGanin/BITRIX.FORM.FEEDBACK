<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arResult["INPUTS"][0]["NAME"] = "Имя";
$arResult["INPUTS"][0]["TYPE"] = "text";
$arResult["INPUTS"][0]["CODE"] = "name";
$arResult["INPUTS"][0]["CLASS"] = "checkit";
$arResult["INPUTS"][0]["LABEL"] = 1;
$arResult["INPUTS"][0]["VALUE"] = "";

$arResult["INPUTS"][1]["NAME"] = "Телефон";
$arResult["INPUTS"][1]["TYPE"] = "text";
$arResult["INPUTS"][1]["CODE"] = "phone";
$arResult["INPUTS"][1]["CLASS"] = "checkit";
$arResult["INPUTS"][1]["LABEL"] = 1;
$arResult["INPUTS"][1]["VALUE"] = "";

$arResult["INPUTS"][2]["NAME"] = "Электронная почта";
$arResult["INPUTS"][2]["TYPE"] = "text";
$arResult["INPUTS"][2]["CODE"] = "email";
$arResult["INPUTS"][2]["CLASS"] = "checkit";
$arResult["INPUTS"][2]["LABEL"] = 1;
$arResult["INPUTS"][2]["VALUE"] = "";

$arResult["INPUTS"][3]["NAME"] = "Текст сообщения";
$arResult["INPUTS"][3]["TYPE"] = "textarea";
$arResult["INPUTS"][3]["CODE"] = "message";
$arResult["INPUTS"][3]["CLASS"] = "checkit";
$arResult["INPUTS"][3]["LABEL"] = 1;
$arResult["INPUTS"][3]["VALUE"] = "";

$arResult["INPUTS"][4]["NAME"] = "";
$arResult["INPUTS"][4]["TYPE"] = "hidden";
$arResult["INPUTS"][4]["CODE"] = "token";
$arResult["INPUTS"][4]["CLASS"] = "";
$arResult["INPUTS"][4]["LABEL"] = 0;
$arResult["INPUTS"][4]["VALUE"] = "";

$arResult["INPUTS"][5]["NAME"] = "";
$arResult["INPUTS"][5]["TYPE"] = "hidden";
$arResult["INPUTS"][5]["CODE"] = "emailto";
$arResult["INPUTS"][5]["CLASS"] = "";
$arResult["INPUTS"][5]["LABEL"] = 0;
$arResult["INPUTS"][5]["VALUE"] = encrypt($arParams['EMAIL'], 'qwTYrSQ*&%0asdfasfCDSVGDgeq~de1QcvSde*&34|\.ddf');

$arResult["INPUTS"][6]["NAME"] = "Нажимая на кнопку «Отправить», я даю согласие на <a href='/soglasie.pdf' target='_blank'>обработку персональных данных</a>";
$arResult["INPUTS"][6]["TYPE"] = "checkbox";
$arResult["INPUTS"][6]["CODE"] = "agreement";
$arResult["INPUTS"][6]["CLASS"] = "checkit";
$arResult["INPUTS"][6]["LABEL"] = 1;
$arResult["INPUTS"][6]["VALUE"] = "";

$this->includeComponentTemplate();