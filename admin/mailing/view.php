<?
// ====================================\
  @include_once('_dir.php');
  $TITLE="Mailing List";
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_head.php");
?>



<?
// ============================================================================\

  $ID=(int)$ID;
  if ($ID<0) $ID=0;

  $Repeat=isset($error);
  $DBdata=($ID && !$Repeat);
  if ($DBdata) @extract(@$sql_fetch_assoc(db_query(
			"select time,active,unsubscribed,email,name
			from mailing_emails where emlID=$ID")));
  elseif (!$ID && !$Repeat) $active=1;//$unsubscribed=1;

  call("intval",array(&$active,&$unsubscribed));
  call("to_html",call("chop",array(&$email,&$name)));

  $url_data_url=to_url($url_data);
// ============================================================================/
?>


<table border=0 cellspacing=0 cellpadding=0>
<tr valign=baseline>
  <td class=txtB>
  <a href='./?ShowEmails=1&<?= $url_data ?>'>- Return to mailing list</a><br>
  <a href='view.php?url_data=<?= $url_data_url ?>'>- Add another address</a><br>
  </td>
<? if ($ID) { ?>
  <td width=50></td>
  <td class=txtB>
  <a href='delete.php?ID=<?= $ID ?>&url_data=<?= $url_data_url ?>' onClick="return makeSure()">- Delete this address</a><br>
  </td>
<? } ?>
</tr>
</table>


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
  if (!checkEmail(f.email.value)) {
    alert('Wrong Email')
    f.email.focus()
    f.email.select()
    return false
    }
  }
//-->
</script>

<form name="update" action="update.php?ID=<?= $ID ?>#edit" method=post
	onSubmit="return formSubmitOnce(this,checkUpdate(this))">

<input type=hidden name='url_data' value="<?= to_html($url_data) ?>">

<div class=head>&nbsp; <?= (!$ID) ? 'Add New Address' : 'Edit Address' ?></div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<?
// ------------------------------------\
  report_error($error);
// ------------------------------------/
?>

<?
  $star='<span class=star>*</span>';
?>
- Fields marked by <?= $star ?> are required.<br>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<table border=0 cellspacing=0 cellpadding=1 class="border">
<tr><td>
<table border=0 cellspacing=1 cellpadding=2 width=500>

<tr valign=baseline class="bgH">
  <td class="txt">Active:</td>
  <td class="bg"><input type=checkbox name="active" value="1" <?= $active ? 'checked' : '' ?>></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txtB"><?= $star ?> Email:</td>
  <td class="bg"><input type=text name="email" size=52 maxlength=100 value="<?= $email ?>"></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txt">Name:</td>
  <td class="bg"><input type=text name="name" size=32 maxlength=50 value="<?= $name ?>"></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txt">Unsubscribed:</td>
  <td class="bg"><input type=checkbox name="unsubscribed" value="1" <?= $unsubscribed ? 'checked' : '' ?>></td>
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
