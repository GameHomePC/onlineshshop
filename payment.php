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

  $Res=_LOAD_DATA("$SC_SITE_SECURE_URL/EXTERNAL/payment.php?no_discount=1&GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&new_payment_url=".to_url('payment_process.html').'&new_cvv_url='.to_url('cvv/').($error ? '' : '').translate_to_url(),'POST');
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
  $FromDisc=3;
  include('modules/sc_info.php');
  echo '<br>',$Res;
  }
//-------------------------------/
?>

</center>

<?
  include_once("$ROOT_PATH/common/all_tail.php");
?>