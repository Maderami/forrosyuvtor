<?php
global $APPLICATION;

use Bitrix\Main\Localization\Loc;


if (!check_bitrix_sessid()) {
    return '';
}
$install_count = \Bitrix\Main\Config\Configuration::getInstance()->get('maindz_module_yas');

if ($exec = $APPLICATION->GetException()) {
    $res = array(
        "TYPE" => "ERROR",
        "MESSAGE" => Loc::getMessage("MOD_UNINST_ERR"),
        "DETAILS" => $exec->GetString(),
        "HTML" => true
    );
    echo CAdminMessage::ShowMessage($res);
}
else{
    echo CAdminMessage::ShowNote(Loc::getMessage("MOD_UNINST_OK"));
}

echo CAdminMessage::ShowMessage(array("MESSAGE" => Loc::getMessage("MAINDZ_YAS_UNINSTALL_COUNT") . $install_count['uninstall'], 'TYPE' => 'OK'));

?>
<form action="<?php echo $APPLICATION->GetCurPage()?>">
    <input type="hidden" name="lang" value="<?=LANGUAGE_ID?>"/>
    <input type="submit" name="" value="<?=Loc::getMessage("MOD_BACK")?>"/>
</form>
