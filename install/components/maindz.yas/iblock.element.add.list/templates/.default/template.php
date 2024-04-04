<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
$this->setFrameMode(false);

$colspan = 2;
if ($arResult["CAN_EDIT"] == "Y") $colspan++;
if ($arResult["CAN_DELETE"] == "Y") $colspan++;
?>
<?if ($arResult["MESSAGE"] <> ''):?>
	<?ShowNote($arResult["MESSAGE"])?>
<?endif?>
<div class="card mb-3"> 
<?if($arResult["NO_USER"] == "N"):?>
	<div class="card-header">
 
			<h3<?=$colspan > 1 ? " colspan=\"".$colspan."\"" : ""?>><?=GetMessage("IBLOCK_ADD_LIST_TITLE")?></h3>

	</div>
	<div class="card-body">
	<?if (count($arResult["ELEMENTS"]) > 0):?>
		<?foreach ($arResult["ELEMENTS"] as $arElement):?>
		<div>
			<h4><?=$arElement["NAME"]?></h4>
			<p><small><?=is_array($arResult["WF_STATUS"]) ? $arResult["WF_STATUS"][$arElement["WF_STATUS_ID"]] : $arResult["ACTIVE_STATUS"][$arElement["ACTIVE"]]?></small></p>
			<?if ($arResult["CAN_EDIT"] == "Y"):?>
			<p><?if ($arElement["CAN_EDIT"] == "Y"):?><a href="<?=$arParams["EDIT_URL"]?>?edit=Y&amp;CODE=<?=$arElement["ID"]?>"><?=GetMessage("IBLOCK_ADD_LIST_EDIT")?><?else:?>&nbsp;<?endif?></a></p>
			<?endif?>
			<?if ($arResult["CAN_DELETE"] == "Y"):?>
			<p><?if ($arElement["CAN_DELETE"] == "Y"):?><a href="?delete=Y&amp;CODE=<?=$arElement["ID"]?>&amp;<?=bitrix_sessid_get()?>" onClick="return confirm('<?echo CUtil::JSEscape(str_replace("#ELEMENT_NAME#", $arElement["NAME"], GetMessage("IBLOCK_ADD_LIST_DELETE_CONFIRM")))?>')"><?=GetMessage("IBLOCK_ADD_LIST_DELETE")?></a><?else:?>&nbsp;<?endif?></p>
			<?endif?>
		</div>
		<?endforeach?>
	<?else:?>
		<tr>
			<td<?=$colspan > 1 ? " colspan=\"".$colspan."\"" : ""?>><?=GetMessage("IBLOCK_ADD_LIST_EMPTY")?></td>
		</tr>
	<?endif?>
	</div>
<?endif?>
	<div class="card-footer">
		<div>
			<p<?=$colspan > 1 ? " colspan=\"".$colspan."\"" : ""?>><?if ($arParams["MAX_USER_ENTRIES"] > 0 && $arResult["ELEMENTS_COUNT"] < $arParams["MAX_USER_ENTRIES"]):?><a href="<?=$arParams["EDIT_URL"]?>?edit=Y"><?=GetMessage("IBLOCK_ADD_LINK_TITLE")?></a><?else:?><?=GetMessage("IBLOCK_LIST_CANT_ADD_MORE")?><?endif?></p>
		</div>
	</div>
</div>
<?if ($arResult["NAV_STRING"] <> ''):?><?=$arResult["NAV_STRING"]?><?endif?>