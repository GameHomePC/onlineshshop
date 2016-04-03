<?
// ====================================\
  @include_once('_dir.php');
  $TITLE="User Management";
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_head.php");
?>



<?
// ============================================================================\

  $ID=(int)$ID;
  if ($ID<2) $ID=0;

// ============================================================================/
?>


<a name="edit"></a>
<?
// ------------------------------------\
  report_ok($OK);
  report_error($error);
// ------------------------------------/
?>


<table border=0 cellspacing=0 cellpadding=0>
<tr valign=top>
  <td>
<?
// ============================================================================\
?>
<?
// ----------------------------------------------------------------------------\
  $res=db_query("select admID,type,login,email from admin
		where type>$Type order by type,login");
// ----------------------------------------------------------------------------/
?>

<div class=head>&nbsp; Existing Users:</div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<table border=0 cellspacing=0 cellpadding=1 class="border">
<tr><td>
<table border=0 cellspacing=1 cellpadding=2>

<tr valign=baseline class="bgH">
  <td class="txtB" align=center nowrap>#</td>
  <td class="txtB" align=center nowrap>Type</td>
  <td class="txtB" nowrap>Username</td>
  <td class="txtB"><a href='./'>Add</a></td>
</tr>

<?
  for ($i=1; $row=@$sql_fetch_assoc($res); $i++) {
    list($log,$eml)=call('to_html',$row['login'],$row['email']);
    echo "<tr valign=baseline class=bg>
	<td align=right class=txtB>$i&nbsp;</td>
	<td class=txt align=center>{$ADMIN_TYPE[$row[type]]}</td>
	<td class=txtB><a href='mailto:$eml'>$log</a></td>
	<td class=txtB nowrap>
		<a href='./?ID=$row[admID]'>Edit</a> /
		<a href='delete.php?ID=$row[admID]'
		onClick='return makeSure()'>Delete</a></td>
	</tr>";
    }
?>

</table>
</td></tr>
</table>
<?
// ============================================================================/
?>
  </td>
  <td width=20>&nbsp;&nbsp;&nbsp;</td>
  <td width=1 bgcolor=black><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=1 alt=''></td>
  <td width=20>&nbsp;&nbsp;&nbsp;</td>
  <td>
<?
// ============================================================================\
?>
<?
// ----------------------------------------------------------------------------\
  $Repeat=isset($error);
  $DBdata=($ID && !$Repeat);
  if ($DBdata) @extract(@$sql_fetch_assoc(db_query(
		"select type,login,password,email,question,answer from admin where admID=$ID")));

  $type=(int)$type;
  if ($type<=$Type) $type=$Type+1;
  call("to_html",call("chop",array(&$login,&$email,&$question,&$answer)));
  $password=to_html($password);
// ----------------------------------------------------------------------------/
?>

<script language=javascript><!--
function checkUpdate(f) {
    if (! self.allLoaded) return errorNotAllLoaded()
  if (!f.login.value.length) {
    alert('Enter username')
    f.login.focus()
    return false
    }
  if (!f.password.value.length) {
    alert('Enter password')
    f.password.focus()
    return false
    }
  if (!checkEmail(f.email.value)) {
    alert('Wrong E-Mail')
    f.email.focus()
    f.email.select()
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
  }
//-->
</script>

<form name="update" action="update.php?ID=<?= $ID ?>#edit" method=post
	onSubmit="return formSubmitOnce(this,checkUpdate(this))">

<div class=head>&nbsp; <?= (!$ID) ? 'Add New User' : 'Edit User' ?></div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<?
  $star='<span class=star>*</span>';
?>
- Fields marked by <?= $star ?> are required.<br>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<table border=0 cellspacing=0 cellpadding=1 class="border">
<tr><td>
<table border=0 cellspacing=1 cellpadding=2>

<tr valign=baseline class="bgH">
  <td class="txt">Type:</td>
  <td class="bg"><?= get_elem(create_select("type",$ADMIN_TYPE,$type,0,0,$Type+1)) ?></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txtB"><?= $star ?> Username:</td>
  <td class="bg"><input type=text name="login" size=30 maxlength=50 value="<?= $login ?>"></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB"><?= $star ?> Password:</td>
  <td class="bg"><input type=password name="password" size=30 maxlength=50 value="<?= $password ?>"></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB"><?= $star ?> E-Mail:</td>
  <td class="bg"><input type=text name="email" size=30 maxlength=100 value="<?= $email ?>"></td>
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
  </td>
</tr>
</table>



<?
  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_tail.php");
?>
