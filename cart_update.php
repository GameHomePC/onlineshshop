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

$Res=_LOAD_DATA("$SC_SITE_URL/EXTERNAL/cart_update.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&get_quantity=1".translate_to_url());
if ($error=get_error($Res)) {	
	$CheckPageExisting=0;
	include_once('sc.php');
	exit;
	}

$SC_QUANTITY=(int)$Res;


if ($form_changed!=2 || !$SC_QUANTITY) $url='sc.html?OK=1';
elseif ($CUSTOMER_ID) $url="$SECURE_URL_HEADER/addresses.html";
else $url="$SECURE_URL_HEADER/choice.html";

redirect($url);

?>