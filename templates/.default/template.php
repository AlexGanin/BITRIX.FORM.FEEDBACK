<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<form id="form_feedback" method="POST" class="form_feedback p-3">

<p class='h1'>Написать нам</p>

<p>С данной страницы вы можете отправить сообщение а администрацию сайта, в редакцию или сообщить нам новость.</p>

<!-- <div class="status alert alert-warning my-2"></div> -->


<?foreach($arResult["INPUTS"] as $input):?>
    <div class="form-group">

        <?if($input['TYPE'] == "textarea"):?>

            <?if($input['LABEL']):?>
                <label for="<?=$input['CODE']?>"><?=$input["NAME"]?></label>
            <?endif?>  

            <textarea name="<?=$input['CODE']?>" id="<?=$input['CODE']?>" class='form-control <?=$input['CLASS']?>' rows='10'><?=$input['VALUE']?></textarea>

        <?elseif($input['TYPE'] == "checkbox"):?>

            <input type="<?=$input['TYPE']?>" checked name="<?=$input['CODE']?>" id="<?//=$input['CODE']?>" class="<?=$input['CODE']?> <?=$input['CLASS']?>" value="<?=$input['VALUE']?>">
            <?if($input['LABEL']):?>
                <label for="<?=$input['CODE']?>"><?=$input["NAME"]?></label>
            <?endif?>  

        <?else://if($input['TYPE'] == "text")?>

            <?if($input['LABEL']):?>
                <label for="<?=$input['CODE']?>"><?=$input["NAME"]?></label>
            <?endif?>

            <input type="<?=$input['TYPE']?>" name="<?=$input['CODE']?>" id="<?//=$input['CODE']?>" class="form-control <?=$input['CODE']?> <?=$input['CLASS']?>" value="<?=$input['VALUE']?>">

        <?endif;?>

    </div>
<?endforeach;?>



<!-- <div class="form-group">
    <label for="files">Файл</label>
    <input type="file" name="files" id="files" class="form-control" value="12345" multiple>
</div> -->

<!-- <div class="form-group">
    <input type="hidden" name="token" id="token">
</div> -->

<!-- <div class="form-group">
    <input type="hidden" name="emailto" id="emailto" value="<?//=encrypt($arParams['EMAIL'], 'qwTYrSQ*&%0asdfasfCDSVGDgeq~de1QcvSde*&34|\.ddf')?>">
</div> -->

<!-- <div class="form-group">
    <input type='checkbox' checked name='agreement' id='agreement' class='agreement'>
    <label for='agreement'>Нажимая на кнопку «Отправить», я даю согласие на <a href='/soglasie.pdf' target='_blank'>обработку персональных данных</a></label>
</div> -->

<input type='submit' name='form-submit-write-to-us g-recaptcha' class='btn text-white bckg-blue' value='Отправить' data-sitekey='reCAPTCHA_site_key' data-callback='onSubmit' data-action='submit'>

<div>
    <small>This site is protected by reCAPTCHA and the Google 
        <a href="https://policies.google.com/privacy">Privacy Policy</a> and
        <a href="https://policies.google.com/terms">Terms of Service</a> apply.
    </small>
</div>

</form>









