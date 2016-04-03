<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

//--------------------------\
  if (!$SC_QUANTITY) {
    redirect('sc.html');
    exit;
    }
  if (!$CUSTOMER_ID) {
    redirect('choice.html');
    exit;
    }
//--------------------------/

$Res=_LOAD_DATA("$SC_SITE_SECURE_URL/EXTERNAL/shipping_process.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION".translate_to_url());
if ($error=get_error($Res)) {	
	$CheckPageExisting=0;
	include('shipping.php');
	exit;
	}

redirect('payment.html');
?>