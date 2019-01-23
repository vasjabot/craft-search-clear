<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
?>
<?
if (isset($_GET['q']))
	if (preg_match("/[a-zР°-СЏС‘]/u",iconv('windows-1251','UTF-8',$_GET['q']))===1) {
		$url = 'Location: ' . $_SERVER['SCRIPT_URL'] . '?q=' . urlencode(mb_strtoupper($_GET['q'], 'windows-1251'));
		if (isset($_GET['PAGEN_1']))
			$url .= '&PAGEN_1=' . $_GET['PAGEN_1'];
		header('HTTP/1.1 301 Moved Permanently');
		header($url);
	}
$arResult["REQUEST"]["QUERY"] = mb_strtoupper($arResult["REQUEST"]["QUERY"], 'windows-1251');
$phrase  = $arResult["REQUEST"]["QUERY"];
//$healthy = array("Аккумулятор ", "аккумулятор ", "Аккумулятор", "аккумулятор", "для ", "для");
//$yummy   = array("", "", "", "", "", "");
//$healthy = array("А", "а", "к", "у", "л", "м", "я", "т", "о", "р", "р ", "д", "я ");
//$yummy   = array("", "", "", "", "", "", "", "", "", "", "", "", "");

//$newphrase = str_replace($healthy, $yummy, $phrase);
$newphrase = preg_replace("![А-Яа-я]!i", '', $phrase);
?>
<?
if (is_object($arResult["NAV_RESULT"])) {
	$title = "Аккумулятор ".$newphrase."";
	$description = "Аккумуляторы CRAFTMANN ".$newphrase." полностью совместимы и взаимозаменяемы с аккумуляторами, установленными в мобильные устройства. Подобрать аккумулятор по марке мобильного устройства также можно в каталоге аккумуляторов. ";
	$keywords = "".$newphrase." найти подобрать поиск аккумулятор модель совместимость купить акб";
} else {
	$title = "Поиск аккумулятора";
	$description = "Если обычный поиск по названию устройства не дал результатов, то рекомендуем воспользоваться поиском по артикулу или оригинальному коду.";
	$keywords = "найти подобрать поиск аккумулятор модель совместимость акб";
}
//Произведен поиск аккумулятора [BL-5C] по нашей информационной базе. Много лет мы занимаемся сбором информации, проверкой и установкой совместимости аккумуляторов для различных мобильных устройств.
$APPLICATION->SetPageProperty("keywords", "$keywords");
$APPLICATION->SetPageProperty("description", "$description");
$APPLICATION->SetPageProperty("title", $title);?>
<?$Prefix = "Аккумулятор для " . " ";?>
<div class="search-page">

<?
if ((count($arResult["SEARCH"])>0) and (is_object($arResult["NAV_RESULT"]))) {
	echo "<h1>Результат поиска: ";  echo $arResult["REQUEST"]["QUERY"]; echo "</h1>";
} elseif (count($arResult["SEARCH"])==0 and is_object($arResult["NAV_RESULT"])) {
	echo "<h1>УПС!</h1>";
} else {
	echo "<h1>Поиск аккумулятора</h1>";
}
?>
<?
if (is_object($arResult["NAV_RESULT"])) {
	echo "<div class=\"search-advanced\">";
	//echo GetMessage("CT_BSP_FOUND"); 
	//echo ": "; 
	//echo $arResult["NAV_RESULT"]->SelectedRowsCount(); 
	echo "</div></div>";
echo "<div style=\"float:right;width:400px;padding-top:5px;\">";
	echo "<div class=\"clear\"></div>";
?>
<?if(count($arResult["SEARCH"])>0):?>
<img alt="База совместимости позволяет сократить время на поиск аккумулятора (акб) <?=$newphrase;?>" src="/upload/medialibrary/423/Add_compatibility+800.jpg" title="Добавление совместимости аккумуляторов <?=$newphrase;?>" style="margin-left: 0;width: 400px;" align="right">
<?
	echo "<p style=\"color: #353535;margin-left: 20px;\">Произведен поиск аккумулятора <b>";  echo $newphrase; echo "</b> по нашей информационной базе. Много лет мы занимаемся сбором информации, проверкой и установкой <a href=\"/technology/compatibility/\"><b class=\"seo\">совместимости аккумуляторов</b></a> для различных мобильных устройств. Подобрать аккумулятор по марке мобильного устройства также можно в <a href=\"/akkumulyator/\">каталоге аккумуляторов</a>. Мы будем благодарны, если вы сообщите об ошибке или об установленной вами совместимости. Эта информация поможет другим людям быстрее и правильнее подобрать аккумулятор для своего устройства.</p><br>";
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"compatibility",
	array(
		"CACHE_TIME" => "1780",
		"CACHE_TYPE" => "A",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"COMPONENT_TEMPLATE" => "compatibility",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"EDIT_URL" => "",
"AJAX_MODE" => "Y",  // режим AJAX
"AJAX_OPTION_SHADOW" => "N", // затемнять область
"AJAX_OPTION_JUMP" => "Y", // скроллить страницу до компонента
"AJAX_OPTION_STYLE" => "Y", // подключать стили
"AJAX_OPTION_HISTORY" => "N",
"IGNORE_CUSTOM_TEMPLATE" => "N",
		"LIST_URL" => "",
		"SEF_MODE" => "N",
		"SUCCESS_URL" => "",
		"USE_EXTENDED_ERRORS" => "N",
		"WEB_FORM_ID" => "8",
		"SEF_FOLDER" => "/search1/",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);
?>
<?else:?>
<img alt="Если поиск аккумулятора по модели, артикулу и оригинальному коду не дал результатов, отправьте сообщение через форму обратной связи." src="/upload/medialibrary/d68/out_of_stock+.jpg" title="Аккумулятор не найден. Попробуйте изменить условия поиска." width="400" height="300" style="margin-top: 0;">
<div style="width:400px;margin-left: 20px;">
<?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"notfound", 
	array(
		"CACHE_TIME" => "1780",
		"CACHE_TYPE" => "A",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"COMPONENT_TEMPLATE" => "notfound",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"EDIT_URL" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"LIST_URL" => "",
		"MARK_NAME" => "",
		"MODEL_NAME" => "",
		"SEF_FOLDER" => "/akkumulyator/apple/",
		"SEF_MODE" => "N",
		"SUCCESS_URL" => "",
		"USE_EXTENDED_ERRORS" => "N",
		"WEB_FORM_ID" => "3",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);?>
</div>
<?endif;?>
<?
echo "</div>";
} else {
     echo "<b style=\"color: #838281;position: absolute;display: flex;top: 60px;\">
Чтобы купить аккумулятор, надо сначала найти этот аккумулятор</b><br>
<p>
	Поиск может быть произведен по названию устройства, оригинальному коду или артикулу аккумулятора. Если Вы не уверены как правильно называется модель вашего телефона или аккумулятор, введите известные вам данные в любом порядке.</p>
 <br>";
}
?>
<?if(isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):
	?>
	<div class="search-language-guess">
		<?echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?>
	</div><br />
<?endif;?>

	<div class="search-result" style="width: 55%;display: table;">
	<?if($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false):?>
	<?elseif($arResult["ERROR_CODE"]!=0):?>

	<?elseif(count($arResult["SEARCH"])>0):?>
		<?if($arParams["DISPLAY_TOP_PAGER"] != "N") echo $arResult["NAV_STRING"]?>
<?
$Prototypes = count($arResult["SEARCH"]);
//echo '<pre>';
//print_r($arResult["SEARCH"]);
//echo '</pre>';
?>

		<?foreach($arResult["SEARCH"] as $arItem):?>

<?

//$grab_elem = GetIBlockElement($arItem["ITEM_ID"]);

//$GLOBAL_IBLOCK_ID = 12;

//$arFilter = array('IBLOCK_ID' => $GLOBAL_IBLOCK_ID);
//$rsSections = CIBlockSection::GetList(array(), $arFilter);
//while ($arSection = $rsSections->Fetch())
//{
//$str_one = mb_strtoupper($arSection['SEARCHABLE_CONTENT']);
	//echo '<pre>';
	//var_dump($ar_res['DEPTH_LEVEL']);
	//echo '</pre>';
//}

	//echo '<pre>';
	//print_r($arItem["TITLE"]);
	//echo '</pre>';


$arItem['ITEM_ID'] = substr($arItem['ITEM_ID'],1);

//echo '<pre>';
//print_r($arItem['ITEM_ID']);
//echo '</pre>';


$res = CIBlockSection::GetByID($arItem['ITEM_ID']);
if($ar_res = $res->GetNext())
{
	//echo '<pre>';
	//print_r($ar_res["CODE"]);
	//echo '</pre>';

	$res_inside = CIBlockSection::GetByID($ar_res['IBLOCK_SECTION_ID']);

	if($ar_res_inside = $res_inside->GetNext())
	{
		//echo '<pre>';
		//print_r($ar_res_inside['NAME']);
		//echo '</pre>';
	}

}



?>
<?
$list = $ar_res["ID"];
$activeElements = CIBlockSection::GetSectionElementsCount($list);

/*if ($activeElements>0) {
		echo "Батареек больше 0<br>";
		echo count($activeElements);
	echo"шт<br>";
	//print_r($ar_res["ID"]);
} 
else {
	echo "Нет в наличии или не существует<br>";
	echo count($activeElements);
	echo"шт<br>";
	//print_r($ar_res["ID"]);
}*/
$PrototypesShow = $Prototypes-$activeElements;
if ($Prototypes==1){
LocalRedirect($arItem["URL"], false, '301 Moved permanently');
}
if ($PrototypesShow==0){
LocalRedirect($arItem["URL"], false, '301 Moved permanently');
}
$Producer=$ar_res['DEPTH_LEVEL'];
?>
<?/*
echo "PrototypesShow ";
echo ($PrototypesShow);
echo "<br>";
echo "Prototypes ";
echo ($Prototypes);
echo "<br>";
echo "activeElements ";
echo ($activeElements);
echo "<br>";
*/
//echo "<pre>";
//print_r($arItem["ID"]);
//echo "</pre>";
?>

		<?if ($activeElements>=1 and $Producer>=2):?>
<?
//$grab = GetIBlockElement($arItem["ITEM_ID"]);
//$price = CItem::GetPath($grab["PRICE"]);
$image = CFile::GetPath($ar_res["PICTURE"]);

?>
<div class="search-item">
<table border="0" cellpadding="1" cellspacing="1" style="width: 520px;">
	<tbody>
		<tr>
			<td style="vertical-align: top; width: 315px;">
			<div class="search-preview">
			<h4 style="margin: 0 auto;">
<?if ($ar_res["CODE"]==craftmann_uni_1500 || $ar_res["CODE"]==craftmann_uni_1250 || $ar_res["CODE"]==craftmann_uni_250 || $ar_res["CODE"]==craftmann_uni_500 || $ar_res["CODE"]==craftmann_uni_750):?>
			<a href="<?echo $arItem["URL"]?>"><?echo $arItem["TITLE"]?></a>
<?else:?>
			<a href="<?echo $arItem["URL"]?>"><?=$Prefix?><br><?echo $ar_res_inside['NAME']?> <?echo $arItem["TITLE"]?></a>
<?endif?>			</h4>
			</div>
			</td>
			<td rowspan="2" style="vertical-align: middle; text-align: center; width: 205px;">
			<?if($image!=''):?>
			<img alt="<?echo $ar_res_inside['NAME']?> <?echo $arItem["TITLE"]?>" title="<?echo $ar_res_inside['NAME']?> <?echo $arItem["TITLE"]?>" src="<?=$image;?>" vspace="5" hspace="5" style="height: 100px;" />
			<?endif?>
			</td>
		</tr>
		<tr>
<?if ($ar_res["CODE"]==craftmann_uni_1500 || $ar_res["CODE"]==craftmann_uni_1250 || $ar_res["CODE"]==craftmann_uni_250 || $ar_res["CODE"]==craftmann_uni_500 || $ar_res["CODE"]==craftmann_uni_750):?>
<?else:?>
			<td style="vertical-align: top;">
			<?
			$dbSection = CIBlockSection::GetList(Array(), array("ID" => $ar_res['ID'], "IBLOCK_ID" => 12), false ,Array("UF_BATTERYTYPE", "UF_DEVTYPE", "UF_PRDDATE"));
			if($arSection = $dbSection->GetNext()){ 
			   $arResult["MY_SECTION"] = $arSection; 
			}
			if($arResult["MY_SECTION"]['UF_DEVTYPE'] === "PDA")
			{
				$devtypes = "смартфон";
			}
			else if($arResult["MY_SECTION"]['UF_DEVTYPE'] === "MOBILE PHONES")
				{
					$devtypes = "телефон";
				}
				else if($arResult["MY_SECTION"]['UF_DEVTYPE'] === "TABLET PC")
					{
						$devtypes = "планшет";
					}
					else
					{
						$devtypes = "устройство";
					}
			?>
			<dl class="characts-list" style="font-size: 13px;">
			<dt>
			Тип
			</dt>
			<dd>
			<?=$devtypes?>
			</dd>
			<dt>
			Год выпуска
			</dt>
			<dd>
			<?=$arResult["MY_SECTION"]["UF_PRDDATE"]?>
			</dd>
			<dt>
			Оригинальный код
			</dt>
			<dd>
				<b class="seo" title="<?=$arResult["MY_SECTION"]["UF_BATTERYTYPE"]?>"><?=$arResult["MY_SECTION"]["UF_BATTERYTYPE"]?></b>
			</dd>
			</dl>
			</td>
<?endif?>
		</tr>
	</tbody>
</table>
	<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"search", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "BUY",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/cart/",
		"BROWSER_TITLE" => "UF_TITLE",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"COMPONENT_TEMPLATE" => "search",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CONVERT_CURRENCY" => "N",
		"CUSTOM_FILTER" => "",
		"DETAIL_URL" => $arItem["URL"],
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "asc",
		"ENLARGE_PRODUCT" => "STRICT",
		"FILTER_NAME" => "arrFilter",
		"HIDE_NOT_AVAILABLE" => "L",
		"HIDE_NOT_AVAILABLE_OFFERS" => "Y",
		"IBLOCK_ID" => "12",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "N",
		"LABEL_PROP" => array(
		),
		"LABEL_PROP_MOBILE" => "",
		"LABEL_PROP_POSITION" => "top-left",
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "1",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "КУПИТЬ",
		"MESS_BTN_COMPARE" => "Сравнить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "UF_DESCRIPTION",
		"META_KEYWORDS" => "UF_KEYWORDS",
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "5",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "retail",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'9','BIG_DATA':false},{'VARIANT':'9','BIG_DATA':false},{'VARIANT':'9','BIG_DATA':false},{'VARIANT':'9','BIG_DATA':false},{'VARIANT':'9','BIG_DATA':false}]",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE" => array(
			0 => "TYPE",
			1 => "VOLTAGE",
			2 => "POWER",
			3 => "CAPACITY",
			4 => "",
		),
		"PROPERTY_CODE_MOBILE" => array(
		),
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => $ar_res["CODE"],
		"SECTION_CODE_PATH" => "#SITE_DIR#/akkumulyator/",
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SEF_RULE" => "#SECTION_CODE#",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "N",
		"TEMPLATE_THEME" => "green",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N"
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);?>
</div>
<?endif?>
		<?endforeach;?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"] != "N") echo $arResult["NAV_STRING"]?>
		<?if($arParams["SHOW_ORDER_BY"] != "N"):?>
			<div class="search-sorting"><label><?echo GetMessage("CT_BSP_ORDER")?>:</label>&nbsp;
			<?if($arResult["REQUEST"]["HOW"]=="d"):?>
				<a href="<?=$arResult["URL"]?>&amp;how=r"><?=GetMessage("CT_BSP_ORDER_BY_RANK")?></a>&nbsp;<b><?=GetMessage("CT_BSP_ORDER_BY_DATE")?></b>
			<?else:?>
				<b><?=GetMessage("CT_BSP_ORDER_BY_RANK")?></b>&nbsp;<a href="<?=$arResult["URL"]?>&amp;how=d"><?=GetMessage("CT_BSP_ORDER_BY_DATE")?></a>
			<?endif;?>
			</div>
		<?endif;?>
	<?else:?>
		<?//ShowNote(GetMessage("CT_BSP_NOTHING_TO_FOUND"));
			header("HTTP/1.0 404 Not Found");?>
		<p  style="color: #353535;">Очень жаль, но в нашей базе данных отсутствует <b><?=$arResult["REQUEST"]["QUERY"]?></b>. Попробуйте изменить свой запрос или отправьте нам сообщение через форму обратной связи.</p>
	<?endif;?>
