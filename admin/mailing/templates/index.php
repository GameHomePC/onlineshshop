<?
// ====================================\
  @include_once('_dir.php');
  $TITLE="Mail Templates";
// ====================================/

  $HTMLEditorUsed=1;

  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_head.php");
?>


<div class=txtB>
<a href='../'>Mailing</a> | 
<a href='../?ShowEmails=1'>Mailing List</a> | 
Mail Templates
</div><br>


<?
// ============================================================================\

  $ID=(int)$ID;
  if ($ID<0) $ID=0;

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
  $res=db_query("select tplID,name,html	from mailing_templates order by name");
// ----------------------------------------------------------------------------/
?>

<div class=head>&nbsp; Existing Templates:</div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<table border=0 cellspacing=0 cellpadding=1 class="border">
<tr><td>
<table border=0 cellspacing=1 cellpadding=2>

<tr valign=baseline class="bgH">
  <td class="txtB" align=center nowrap>#</td>
  <td class="txtB" width=200 nowrap>Name</td>
  <td class="txtB"><a href='./'>Add</a></td>
</tr>

<?
  for ($i=1; $row=@$sql_fetch_assoc($res); $i++) {
    $id=$row['tplID'];
    $nm=to_html($row['name']);
    $fm=$row['html'] ? '[html]' : '[text]';
    echo "<tr valign=baseline class=bg>
	<td align=right class=txtB>$i&nbsp;</td>
	<td width=200 >$fm <a href='../?tplID=$id'>$nm</a></td>
	<td class=txtB>
		<a href='./?ID=$id'>Edit</a><br>
		<img src='$SITE_ROOT/img/1x1b.gif' width=95% height=1 vspace=2 alt=''><br>
		<a href='delete.php?ID=$id'
		onClick='return makeSure()'>Delete</a></td>
	</tr>";
    }
?>

</table>
</td></tr>
</table>

<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=300 height=1 alt=''><br>
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
		"select name,html,subject,template from mailing_templates where tplID=$ID")));
  elseif (!$ID && !$Repeat)
    $template_nl2br=0;

  call("to_html",call("chop",array(&$name,&$subject,&$template)));
  $html=(int)$html;
// ----------------------------------------------------------------------------/
?>

<script language=javascript><!--
function checkUpdate(f) {
    if (! self.allLoaded) return errorNotAllLoaded()
  if (!f.name.value.length) {
    alert('Enter template name')
    f.name.focus()
    return false
    }
  }
//-->
</script>

<form name="update" action="update.php?ID=<?= $ID ?>#edit" method=post
	onSubmit="return formSubmitOnce(this,checkUpdate(this))">
<input type=hidden name='for_no_bag1' value=1>

<div class=head>&nbsp; <?= (!$ID) ? 'Add New Template' : 'Edit Template' ?></div>
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
  <td class="txtB"><?= $star ?> Name:</td>
  <td class="bg" nowrap><input type=text name="name" size=32 maxlength=100 value="<?= $name ?>"></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txtB" nowrap>HTML-format:</td>
  <td class="bg"><input type=checkbox name='html' value="1" <?= $html ? 'checked' : '' ?>></td>
</tr>

<tr valign=baseline class="bgH">
  <td class="txt">Subject:</td>
  <td class="bg" nowrap><input type=text name="subject" size=32 maxlength=100 value="<?= $subject ?>"></td>
</tr>

<tr valign=baseline class="bgH">
  <td colspan=2 class="hl">Template
	<div class=note1>
	Following aliases are possible:<br>
	<span class=note2><b>&lt;%NAME%&gt;</b></span> - Name<br>
	<span class=note2><b>&lt;%LINK%&gt;</b></span> - Link URL to unsubscribe<br>
	</div></td>
</tr>
<tr valign=baseline class="bgH">
  <td colspan=2 class="bg">
<?
//----------------------------------------------------\
$ModuleData=array(
	'textarea' => 'template',
	'cols' => '85',
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
  </td>
</tr>
</table>



<?
  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_tail.php");
?>
