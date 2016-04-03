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

  $Res=_LOAD_DATA("$SC_SITE_SECURE_URL/EXTERNAL/shipping.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&new_shipping_url=".to_url('shipping_process.html').translate_to_url());
  $Error=get_error($Res);

  include_once("$ROOT_PATH/common/all_head.php");
?>

<center>

<?
//-----------------------\
report_error($error);
//-----------------------/
?>

<?
//-------------------------------\
if ($Error) report_error($Error);
else {
  $FromDisc=2;
  include('modules/sc_info.php');
  echo '<br>',$Res;
  }
//-------------------------------/
?>

</center>

<?
  include_once("$ROOT_PATH/common/all_tail.php");
?>