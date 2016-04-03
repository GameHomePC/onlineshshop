<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

//--------------------------\
  if ($CUSTOMER_ID) {
    redirect('account.html');
    exit;
    }
//--------------------------/

  if (!$email) $_GET['email']=$SavedEmail;

//  $Res=_LOAD_DATA("$SC_SITE_SECURE_URL/EXTERNAL/login_form.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&new_login_url=".to_url('login.html').translate_to_url());
  $Res=_LOAD_DATA("$SC_SITE_SECURE_URL/EXTERNAL/login_form.php?GET_XML=0&new_login_url=".to_url('login.html').translate_to_url());
  $Error=get_error($Res);

  include_once("$ROOT_PATH/common/all_head.php");
?>

<center>

<?
//----------------------------------\
if ($message) report_ok(1,$message);
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
if (document.login) document.login.email.focus()
//-->
</script>

<?
  include_once("$ROOT_PATH/common/all_tail.php");
?>