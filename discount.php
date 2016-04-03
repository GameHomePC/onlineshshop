<?
// ====================================\
  @include_once('_dir.php');
// ====================================/


//--------------------------------------\
$from=(int)$_GET['from'];
if ($from<0 || $from>3) $from=0;

if (!$from) $ret_url='sc';
elseif ($from==1) $ret_url='addresses';
elseif ($from==2) $ret_url='shipping';
elseif ($from==3) $ret_url='payment';
//--------------------------------------/


$discount_code=trim($discount_code);

//--------------------------------------------------------------------------------\
if ($delete) {
  if (!$DISCOUNT_ID)
    $error='No Discount found';
  }
elseif ($DISCOUNT_ID)
  $error='Discount already applyed';
elseif ($discount_code=='')
  $error='Enter Discount Code';

if ($error) {
  $CheckPageExisting=0;
  include("$ret_url.php");
  exit;
  }

//--------------------------------------------------------------------------------/

$Res=_LOAD_DATA("$SC_SITE_URL/EXTERNAL/discount.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION".translate_to_url(),'POST');
if ($error=get_error($Res)) {	
	$CheckPageExisting=0;
	include("$ret_url.php");
	exit;
	}

$DISCOUNT_ID=$delete ? '' : $discount_code;
session_register1('DISCOUNT_ID');

redirect("$ret_url.html");
?>