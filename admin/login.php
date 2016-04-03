<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

  disable_caching();
  
  $login=trim($login);
  $login_sql=to_sql($login);
  $login_url=to_url($login);

  $url_url=to_url($url=trim($url));

  if ($login!="" &&
	(list($admID,$db_password,$question,$sessID,$time,$IP)=@$sql_fetch_row(db_query(
		"select admID,password,question,sessID,time,IP
		from admin where login='$login_sql'")))) {
//  if ($login!="" && (list($admID,$db_password,$question)=@$sql_fetch_row(db_query(
//			"select admID,password,question	from admin 
//			where login='$login_sql'")))) {

// ============================================================================\

    if ($dologin) {
      if ($password==$db_password) {
// ----------------\
	do $SessID=rand_hex_str();
	while (@$sql_num_rows(db_query("select 1 from admin where sessID=0x$SessID")));
// ----------------/
	db_query("update admin set sessID=0x$SessID,time=$TIME,IP='$CLIENT_IP'
		where admID=$admID");
	setcookie("SessID",$SessID,0,"$SITE_ROOT/","",$SECURE_LOGIN_ONLY);

//	session_start();
//	session_register("ADMIN");
//	$ADMIN=array(
//		"admID" => (int)$admID,
//		"time" => $TIME,
//		"IP" => $CLIENT_IP
//		);
	if ($url) redirect($url);
	else redirect('home.php');
	exit;
	}
      $error="Wrong password";
      }
    else {

// ----------------------------------------------------------------------------\
  $TITLE="Remind Password";
  include_once("$ROOT_PATH/$ADMIN_DIR/common/all_head.php");

  call("to_html",array(&$login,&$question,&$answer));
?>
<br>
<blockquote>
<div class="headerH">Remind Password</div>
<br>
<?
// ------------------------------------\
  report_error($error);
// ------------------------------------/
?>
<div class=txt>- <a href='remind.php?login=<?= $login_url ?>&url=<?= $url_url ?>' class=txtB>CLICK HERE</a> 
to send password to your Email.</div>
<?
  if ($question!="") {
// ------------------------------------\
?>
<script language=javascript><!--
function checkAnswer(f) {
  if (!f.answer.value.length) {
    alert("Enter answer")
    f.answer.focus()
    f.answer.select()
    return false
    }
  }
//-->
</script>

<form action='remind.php?url=<?= $url_url ?>' method=POST
	onSubmit="return formSubmitOnce(this,checkAnswer(this))">
<input type=hidden name='login' value="<?= $login ?>">

<div class="header">Answer on control question</div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<table border=0 cellspacing=0 cellpadding=1 class=border>
<tr><td>
<table border=0 cellspacing=1 cellpadding=2>
<tr valign=baseline class=bgH>
  <td class="txt">Question:</td>
  <td class=bg><div class="note2"><?= $question ?></div></td>
</tr>
<tr valign=baseline class=bgH>
  <td class="txt">Answer:</td>
  <td class=bg><input type=text name='answer' size=50 maxlength=255 value=<?= $answer ?>></td>
</tr>
<tr class=bgH>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class=bg><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>
<tr class=bgH>
  <td></td>
  <td><input class=buttonH type=submit value="Submit >>"></td>
</tr>
</table>
</td></tr>
</table>

</form>
<?
// ------------------------------------/
    }
?>
<div class="txtB"><a href="./?login=<?= $login_url ?>&url=<?= $url_url ?>">&lt;&lt; Return to the login page</a></div>
</blockquote>
<?
  include_once("$ROOT_PATH/$ADMIN_DIR/common/all_tail.php");
  exit;
// ----------------------------------------------------------------------------/

      }

// ============================================================================/

    }
  else
    $error="Nonexistent username";

  include("index.php");
?>