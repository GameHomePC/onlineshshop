<?
// ====================================\
  @include_once('_dir.php');
  $TITLE="Uploaded Files";
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_head.php");
?>


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
  $portion=20;
  $num_rows=@$sql_result(db_query("select count(1) from site_uploads"),0,0);
  $page=(int)$page;
  list($hbar,$lbar,$page)=make_page_bar('./?page=',$num_rows,$page,1,0,$portion);

  $start=$page*$portion;
  $res=db_query("select suplID,time,comment,path,name
		from site_uploads as su, uploads as u
		where su.uplID=u.uplID
		order by time DESC limit $start,$portion");
// ----------------------------------------------------------------------------/
?>

<div class=head>&nbsp; Uploaded Files (<?= $num_rows ?>):</div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<?= $hbar ?>
<div class='txt'><?= $lbar ?></div>

<table border=0 cellspacing=0 cellpadding=1 class="border">
<tr><td>
<table border=0 cellspacing=1 cellpadding=2>

<tr valign=baseline class="bgH">
  <td class="txtB" align=center nowrap>#</td>
  <td class="txtB" align=center nowrap>Time</td>
  <td class="txtB" nowrap>File</td>
  <td class="txtB"><a href='./?ID=-1'>Add</a></td>
</tr>

<?
  $max_l=150;
  for ($i=$start+1; $row=@$sql_fetch_assoc($res); $i++) {
    $time=site_date($TIME_FMT,$row['time']);
    $fname="$row[path]/$row[name]";
    $comm=to_html($row['comment']);
    $class=($ID==$row['suplID']) ? 'bgHl' : 'bg';
    echo "<tr valign=baseline class=$class>
	<td align=right class=txtB>$i&nbsp;</td>
	<td class=f1>$time</td>
	<td class=txt><b><a href='$SITE_ROOT/$fname' target=_blank>$row[name]</a></b><br>
		<nobr class=f1>$SITE_ROOT/$fname</nobr><div class=note>$comm</div></td>
	<td class=txtB>
		<a href='./?ID=$row[suplID]&page=$page'>Edit</a><br>
		<hr size=1 color=#000000 noshade>
		<a href='delete.php?ID=$row[suplID]&page=$page'
		onClick='return makeSure()'>Delete</a></td>
	</tr>";
    }
?>

</table>
</td></tr>
</table>

<div class='txt'><?= $lbar ?></div>
<?= $hbar ?>
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
  $DBdata=($ID>0 && !$Repeat);
  if ($DBdata) @extract(@$sql_fetch_assoc(db_query(
		"select time,uplID,comment from site_uploads
		where suplID=$ID")));

  call('to_html',call('chop',array(&$comment,&$alt)));
  $uplID=(int)$uplID;
// ----------------------------------------------------------------------------/
?>

<script language=javascript><!--
function checkUpdate(f) {
    if (! self.allLoaded) return errorNotAllLoaded()
  if (<?= $ID ?>==-1 && !f.upl.value.length) {
    alert('Choose File')
    f.upl.focus()
    return false
    }
  }
//-->
</script>

<form name="update" action="update.php?ID=<?= $ID ?>&page=<?= $page ?>#edit" 
	method=post enctype=multipart/form-data
	onSubmit="return checkUpdate(this)">

<div class=head>&nbsp; <?= (!$ID) ? 'Upload New File' : 'Edit Uploaded File' ?></div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<?
  $star='<span class=star>*</span>';
?>
<?
  $star='<span class=star>*</span>';
?>
- Fields marked by <?= $star ?> are required.<br>
- File may be in any format 
  <?= $MAX_UPLOAD_FILESIZE ? " and up to $MAX_UPLOAD_FILESIZE KB" : "" ?>.<br>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<table border=0 cellspacing=0 cellpadding=1 class="border">
<tr><td>
<table border=0 cellspacing=1 cellpadding=2>

<tr valign=middle class="bgH">
  <td class="txtB" nowrap><?= $star ?> File:</td>
  <td class="bg">
    <input type=hidden name="uplID" value="<?= $uplID ?>">
    <? if ($uplID) { ?>
    <b><?= file_link($uplID,'','target=_blank') ?></b><br>
    <? } ?><input type=file name="upl">
  </td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt">Comment:</td>
  <td class="bg" nowrap><input type=text name="comment" size=32 maxlength=50 value="<?= $comment ?>"></td>
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
