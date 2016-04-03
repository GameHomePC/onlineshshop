<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

//------------------------------\
  if (!$CUSTOMER_ID) {
    redirect('login_form.html');
    exit;
    }
//------------------------------/

  $Res=_LOAD_DATA("$SC_SITE_SECURE_URL/EXTERNAL/password_form.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&new_password_url=".to_url('account_a.html')."&password=".to_url($password)."&new_password=".to_url($new_password)."&new_password1=".to_url($new_password1),'POST');
  $Error=get_error($Res);

  if (!$Error) {
    $Res_ord=_LOAD_DATA("$SC_SITE_URL/EXTERNAL/orders.php?GET_XML=0&SHOPXML_SESSION=$SHOPXML_SESSION&new_order_view_url=".to_url('order_view.html'));
    $Error=get_error($Res_d);
    }


  include_once("$ROOT_PATH/common/all_head.php");
?>


<?
//----------------------------------\
if ($message) report_ok(1,$message);
report_error($error);
//----------------------------------/
?>

<b class=hl>Change Password</b>
<table border=0 cellspacing=2 cellpadding=4 width=600>
<tr><td class=sc_text>
&#149; If you want change your password, enter your current password and a new password
you wish to use and click the "<b>Change</b>" button.<br>
</td></tr>
</table>


<?
//-------------------------------\
if ($Error) report_error($Error);
else
  echo '<center>',$Res,'</center>',
	"<br><br><b class=hl>Your orders:</b><br>",
	'<center>',$Res_ord,'</center>';
//-------------------------------/
?>



<?
  include_once("$ROOT_PATH/common/all_tail.php");
?>