<?
// ====================================\
  @include_once('_dir.php');
  $TITLE="User Login";
// ====================================/

// ------------------------------------\
  setcookie("SessID",0,0,"$SITE_ROOT/","",$SECURE_LOGIN_ONLY);
  $DB_ERROR_HANDLER=0;
  if (check_hex_str($SessID)) db_query("update admin set sessID=0 where sessID=0x$SessID");
// ------------------------------------/

  $url_url=to_url($url=trim($url));

  include_once("$ROOT_PATH/$ADMIN_DIR/common/all_head.php");
?>


<?
  if (!$SECURE_ACCESS && $SECURE_LOGIN_ONLY) {

// ----------------------------------------------------------------------------\
?>
<br>
<div class="noteH" align=center>
You must connect using secture Internet-protocol (https) for working with this site.<br>
<a href='<?= "$SECURE_URL_HEADER/?url=$url_url" ?>'>CLICK HERE</a> to re-connect using secure protocol.
</div>
<?
// ----------------------------------------------------------------------------/

    }
  else {

// ============================================================================\
?>

<script language=javascript><!--
function checkLogin(f) {
  return checkFilled(f.login,"Please enter your username.")
  }
function checkPassword(f) {
  return checkFilled(f.password,"Please enter your password.")
  }
//-->
</script>

<table border=0 cellspacing=0 cellpadding=0 width=100% height=100%>
<tr><td align=center valign=middle>

<table border=0 cellspacing=0 cellpadding=2 class="border">
<tr><td>
<table border=0 cellspacing=0 cellpadding=2 class="bgH">
<tr><td>&nbsp;</td><td>
<table border=0 cellspacing=0 cellpadding=2>
<form name='login' action='login.php?url=<?= $url_url ?>' method=post
	onSubmit="return formSubmitOnce(this,(checkLogin(this) && checkPassword(this)))">

<tr>
  <td colspan=3 align=center class="headerH">Enter your account data</td>
</tr>

<?
  if ($error) {
// ------------------------------------\
?>
<tr>
  <td colspan=3 align=center class=txt><div class=warn>Error: <?= $error ?></div>
	Try again:</td>
</tr>
<?
// ------------------------------------/
    }
  elseif ($logout) {
// ------------------------------------\
?>
<tr>
  <td colspan=3 align=center class="ok">You have successfully logged out</td>
</tr>
<?
// ------------------------------------/
    }
?>

<?
  call("to_html",array(&$login,&$password));
?>
<tr>
  <td class="txtB">Username:&nbsp;</td>
  <td colspan=2><input type=text name='login' size=30 maxlength=50 value="<?= $login ?>"></td>
</tr>
<tr>
  <td class="txtB">Password:&nbsp;</td>
  <td><input type=password name='password' size=16 maxlength=50	value="<?= $password ?>"></td>
  <td align=right><input class=button type=button value="Remind"
	onClick="if (checkLogin(form)) form.submit()"></td>
</tr>
<tr>
  <td colspan=3 align=center><input class=buttonH type=submit name="dologin" value="Login >>"></td>
</tr>

</form>
</table>
</td><td>&nbsp;</td></tr>
</table>
</td></tr>
</table>

<br><br>
</td></tr>
</table>

<script language=javascript><!--
el=D.login.login
el.select()
el.focus()
//-->
</script>
<?
// ============================================================================/

    }
?>



<?
  include_once("$ROOT_PATH/$ADMIN_DIR/common/all_tail.php");
?>
