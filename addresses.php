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

  $Res=_LOAD_DATA("$SC_SITE_SECURE_URL/EXTERNAL/addresses.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&new_addresses_url=".to_url('addresses_process.html').translate_to_url(),'POST');
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
  $FromDisc=1;
  include('modules/sc_info.php');
  echo '<br>',$Res;
  }
//-------------------------------/
?>

</center>

<?
  include_once("$ROOT_PATH/common/all_tail.php");
?>