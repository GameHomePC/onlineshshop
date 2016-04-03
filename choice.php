<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

//--------------------------\
  if (!$SC_QUANTITY) {
    redirect('sc.html');
    exit;
    }
  if ($CUSTOMER_ID) {
    redirect('addresses.html');
    exit;
    }
//--------------------------/

  if (!$email) $_GET['email']=$SavedEmail;

//  $Res=_LOAD_DATA("$SC_SITE_SECURE_URL/EXTERNAL/login_form.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&new_login_url=".to_url('login.html?choice=1').translate_to_url());
  $Res=_LOAD_DATA("$SC_SITE_SECURE_URL/EXTERNAL/login_form.php?GET_XML=0&new_login_url=".to_url('login.html?choice=1').translate_to_url(),'POST');
  $Error=get_error($Res);

  include_once("$ROOT_PATH/common/all_head.php");
?>


<?
//----------------------------------\
if ($message) report_ok(1,$message);
report_error($error);
//----------------------------------/
?>

<table border=0 cellspacing=0 cellpadding=0 width=100%>
<tr valign=middle align=center>
  <td width=40% style='padding:5'>
    <b class=button2 style='font-size:16;'><a href='addresses.html'>&nbsp; NEW CUSTOMER &nbsp;</a></b>
  </td>
  <td width=60%>

<?
//-------------------------------\
if ($Error) report_error($Error);
else echo $Res;
//-------------------------------/
?>

  </td>
</tr>
</table>

<script language=javascript><!--
if (document.login) document.login.email.focus()
//-->
</script>


<?
  include_once("$ROOT_PATH/common/all_tail.php");
?>