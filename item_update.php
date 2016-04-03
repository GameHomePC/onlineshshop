<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

//--------------------------\
  if (!$SC_QUANTITY) {
    redirect('sc.html');
    exit;
    }
//--------------------------/

$Res=_LOAD_DATA("$SC_SITE_URL/EXTERNAL/item_update.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&get_quantity=1".translate_to_url());
if ($error=get_error($Res)) {	
	$CheckPageExisting=0;
	include_once('item_edit.php');
	exit;
	}

$SC_QUANTITY=(int)$Res;

redirect('sc.html');

?>