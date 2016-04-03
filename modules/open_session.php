<?void();

if (!$SHOPXML_SESSION) {
    $Res=_LOAD_DATA("$SC_SITE_URL/EXTERNAL/session_start.php?shop=$SHOP_ID&SHOPXML_SESSION=".to_url($SHOPXML_SESSION_COPY));
    if ($Error=get_error($Res)) {
	$CheckPageExisting=0;
	include_once("$ROOT_PATH/common/all_head.php");
	report_error($Error);
	include_once("$ROOT_PATH/common/all_tail.php");
	exit;
	}
    else {
	$SHOPXML_SESSION=$SHOPXML_SESSION_COPY=$Res;
	session_register1('SHOPXML_SESSION','SHOPXML_SESSION_COPY');
	}
    }

?>