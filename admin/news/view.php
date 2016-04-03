<?
// ====================================\
  @include_once('_dir.php');
  $TITLE="News Management";
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
  if ($DBdata) {
    @extract(@$sql_fetch_assoc(db_query(
			"select archive,time,title,content,source from news where nwsID=$ID")));
    list($ty,$tm,$td)=call('intval',explode('-',site_date('Y-m-d',$time)));
    }
  elseif (!$ID && !$Repeat)
    list($ty,$tm,$td)=$Date;

  call("intval",array(&$archive,&$td,&$tm,&$ty));
  call("to_html",call("chop",array(&$title,&$content,&$source)));

// ============================================================================/
?>


<table border=0 cellspacing=0 cellpadding=0>
<tr valign=baseline>
  <td class=txtB>
  <a href='./'>- Return to news list</a><br>
  <a href='view.php'>- Add another news</a><br>
  </td>
<? if ($ID) { ?>
  <td width=50></td>
  <td class=txtB>
  <a href='delete.php?ID=<?= $ID ?>' onClick="return makeSure()">- Delete this news</a><br>
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
  if (!f.title.value.length) {
    alert('Enter title')
    f.title.focus()
    return false
    }
  if (!f.content.value.length) {
    alert('Enter content')
    f.content.focus()
    return false
    }
  }
//-->
</script>

<form name="update" action="update.php?ID=<?= $ID ?>#edit" method=post
	onSubmit="return formSubmitOnce(this,checkUpdate(this))">
<input type=hidden name='for_no_bag1' value=1>

<div class=head>&nbsp; <?= (!$ID) ? 'Add News' : 'Edit News' ?></div>
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
  <td class="txt">Date:</td>
  <td class="bg"><?=
	get_elem(create_select('td',$DAY,$td)),
	get_elem(create_select('tm',$MONTH['name'],$tm)),
	get_elem(create_select('ty',$YEAR,$ty))
  ?></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txtB"><?= $star ?> Title:</td>
  <td class="bg"><input type=text name='title' size=52 maxlength=255 value="<?= $title ?>"></td>
</tr>

<tr valign=baseline class="bgH">
  <td colspan=2 class="txtB"><?= $star ?> Content
	<div class=note>(any HTML-code is allowed)</div></td>
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

<tr valign=baseline class="bgH">
  <td class="txt">Source:</td>
  <td class="bg"><input type=text name='source' size=52 maxlength=255 value="<?= $source ?>"></td>
</tr>

<!--
<tr valign=baseline class="bgH">
  <td class="txtB">Archive:</td>
  <td class="bg"><input type=checkbox name='archive' value="1" <?= $archive ? 'checked' : '' ?>></td>
</tr>
-->

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
