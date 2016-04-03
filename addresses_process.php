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

$Res=_LOAD_DATA("$SC_SITE_SECURE_URL/EXTERNAL/addresses_process.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&get_customer_id=1".translate_to_url(),'POST');
if ($error=get_error($Res)) {	
	$CheckPageExisting=0;
	include_once('addresses.php');
	exit;
	}
	
//----------------------------------------------------------\
$first_name=($first_name1!='') ? $first_name1 : $first_name2;
$last_name=($first_name1!='') ? $last_name1 : $last_name2;
$customer_id=(int)$Res;
include_once("$ROOT_PATH/modules/customer_register.php");
//----------------------------------------------------------/

redirect('shipping.html');
?>