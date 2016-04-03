<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

//---------------------------\
  if ($CUSTOMER_ID) {
    redirect('account.html');
    exit;
    }
//---------------------------/

//  $Res=_LOAD_DATA("$SC_SITE_SECURE_URL/EXTERNAL/register_form.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&new_register_url=".to_url('register.html').translate_to_url());
  $Res=_LOAD_DATA("$SC_SITE_SECURE_URL/EXTERNAL/register_form.php?GET_XML=0&new_register_url=".to_url('register.html').translate_to_url());
  $Error=get_error($Res);

  include_once("$ROOT_PATH/common/all_head.php");
?>

<center>

<?
//----------------------------------\
report_error($error);
//----------------------------------/
?>

<?
//-------------------------------\
if ($Error) report_error($Error);
else echo $Res;
//-------------------------------/
?>

</center>

<script language=javascript><!--
if (document.register) document.register.email.focus()
//-->
</script>

<?
  include_once("$ROOT_PATH/common/all_tail.php");
?>