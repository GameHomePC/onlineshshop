<?
// ====================================\
  @include_once('_dir.php');
  $TITLE="Live Stories";
// ====================================/

  $HTMLEditorUsed=1;

  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_head.php");
?>


<?
// ============================================================================\

  $ID=(int)$ID;
  if ($ID<0) $ID=0;

  $Repeat=isset($error);
  $DBdata=($ID && !$Repeat);
  if ($DBdata) @extract(@$sql_fetch_assoc(db_query(
			"select active,priority,title,content
			from stories where strID=$ID")));
  elseif (!$ID && !$Repeat) $active=1;

  call("intval",array(&$active));
  call("to_html",call("chop",array(&$priority,&$title,&$content)));

// ============================================================================/
?>


<table border=0 cellspacing=0 cellpadding=0>
<tr valign=baseline>
  <td class=txtB>
  <a href='./'>- Return to stories list</a><br>
  <a href='view.php'>- Add new story</a><br>
  </td>
<? if ($ID) { ?>
  <td width=50></td>
  <td class=txtB>
  <a href='<?= $SITE_ROOT ?>/story_<?= $ID ?>.html?view_inactive=1' target=_blank>- See this story</a><br>
  <a href='delete.php?ID=<?= $ID ?>' onClick="return makeSure()">- Delete this story</a><br>
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
  if (f.priority.value.length && checkInt(f.priority.value)==null) {
    alert('Wrong value for order')
    f.priority.focus()
    f.priority.select()
    return false
    }
  if (!f.title.value.length) {
    alert('Enter story title')
    f.title.focus()
    return false
    }
  if (!f.content.value.length) {
    alert('Enter story content')
    f.content.focus()
    return false
    }
  }
//-->
</script>

<form name="update" action="update.php?ID=<?= $ID ?>#edit" method=post
	onSubmit="return formSubmitOnce(this,checkUpdate(this))">
<input type=hidden name='for_no_bag1' value=1>

<div class=head>&nbsp; <?= (!$ID) ? 'Add New Story' : 'Edit Story' ?></div>
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
  <td class="txt">Visible:</td>
  <td class="bg"><input type=checkbox name="active" value="1" <?= $active ? 'checked' : '' ?>></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Order (0-255):</td>
  <td class="bg"><input type=text name="priority" size=2 maxlength=3 value="<?= $priority ?>"></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txtB"><?= $star ?> Title:</td>
  <td class="bg"><input type=text name="title" size=52 maxlength=255 value="<?= $title ?>"></td>
</tr>

<tr valign=baseline class="bgH">
  <td colspan=2 class="txtB"><?= $star ?> Content
	<div class=note>(Any HTML-code is allowed)</div></td>
</tr>
<tr valign=baseline class="bgH">
  <td colspan=2 class="bg">
<?
//----------------------------------------------------\
$ModuleData=array(
	'textarea' => 'content',
	'cols' => '75',
	'rows' => '7'
	);
include("$ROOT_PATH/$ADMIN_DIR/modules/textarea.php");
//----------------------------------------------------/
?>
  </td>
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

<input type=hidden name='for_no_bag2' value=1>
</form>
<?
// ============================================================================/
?>



<?
  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_tail.php");
?>
