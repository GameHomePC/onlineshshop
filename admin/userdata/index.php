<?
// ====================================\
  @include_once('_dir.php');
  $TITLE="Edit Profile";
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_head.php");
?>



<?
// ============================================================================\

  $Repeat=isset($error);
  $DBdata=(!$Repeat);
  if ($DBdata) @extract(@$sql_fetch_assoc(db_query(
		"select email,question,answer from admin where admID=$AdmID")));

  call("to_html",call("chop",array(&$email,&$question,&$answer)));
  call("to_html",array(&$newpassword,&$newpassword1,&$password));

// ============================================================================/
?>


<?
// ------------------------------------\
  report_ok($OK);
// ------------------------------------/
?>


<?
// ============================================================================\
?>
<a name="edit"></a>

<script language=javascript><!--
function checkUpdate(f) {
    if (! self.allLoaded) return errorNotAllLoaded()
  if (! checkEmail(f.email.value)) {
    alert('Wrong E-Mail')
    f.email.focus()
    f.email.select()
    return false
    }
  if (f.newpassword.value!=f.newpassword1.value) {
    alert('Password is repeated wrong')
    f.newpassword1.focus()
    f.newpassword1.select()
    return false
    }
  var ql=f.question.value.length
  var al=f.answer.value.length
  if (ql && !al) {
    alert('If question filled then answer must be filled either')
    f.answer.focus()
    return false
    }
  if (!ql && al) {
    alert('If answer filled then question must be filled either')
    f.question.focus()
    return false
    }
  if (!f.password.value.length) {
    alert('Enter current password')
    f.password.focus()
    f.password.select()
    return false
    }
  }
//-->
</script>

<form name="update" action="update.php#edit" method=post
	onSubmit="return formSubmitOnce(this,checkUpdate(this))">

<?
// ------------------------------------\
  report_error($error);
// ------------------------------------/
?>

<?
  $star='<span class=star>*</span>';
?>
- Fields marked by <?= $star ?> are required.<br>
- Leave new password empty if you do not want to change it.<br>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<table border=0 cellspacing=0 cellpadding=1 class="border">
<tr><td>
<table border=0 cellspacing=1 cellpadding=2>

<tr valign=baseline class="bgH">
  <td class="txtB"><?= $star ?> E-Mail:</td>
  <td class="bg"><input type=text name="email" size=30 maxlength=100 value="<?= $email ?>"></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txt">New Password:</td>
  <td class="bg"><input type=password name='newpassword' size=30 maxlength=50 value="<?= $newpassword ?>"></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt">Repeat New Password:</td>
  <td class="bg"><input type=password name='newpassword1' size=30 maxlength=50 value="<?= $newpassword1 ?>"></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txt">Control Question:</td>
  <td class="bg"><input type=text name="question" size=52 maxlength=255 value="<?= $question ?>"></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt">Answer:</td>
  <td class="bg"><input type=text name="answer" size=52 maxlength=255 value="<?= $answer ?>"></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txtB"><?= $star ?> Current Password:</td>
  <td class="bg"><input type=password name='password' size=30 maxlength=50 value="<?= $password ?>"></td>
</tr>

<tr class="bgH">
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td class="bg"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>

<tr class="bgH">
  <td><input class=button type=reset value="Reset"></td>
  <td><input class=buttonH type=submit value="Submit >>"></td>
</tr>

</table>
</td></tr>
</table>
</form>
<?
// ============================================================================/
?>



<?
  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_tail.php");
?>
