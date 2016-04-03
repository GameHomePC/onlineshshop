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

  $index=(int)$index;
  $Res=_LOAD_DATA("$SC_SITE_URL/EXTERNAL/item_edit.php?attributes_by_code=1&GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&index=$index&new_item_update_url=".to_url('item_update.html'));
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
else echo $Res;
//-------------------------------/
?>

</center>


<?
  include_once("$ROOT_PATH/common/all_tail.php");
?>