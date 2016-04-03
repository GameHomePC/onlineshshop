<?
// ====================================\
  @include_once('_dir.php');
  $TITLE="Image Gallery";
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
  $num_rows=@$sql_result(db_query("select count(1) from site_gallery"),0,0);
  $page=(int)$page;
  list($hbar,$lbar,$page)=make_page_bar('./?page=',$num_rows,$page,1,0,$portion);

  $start=$page*$portion;
  $res=db_query("select imgID,time,comment,alt,width,height,path,name
		from site_gallery as g,uploads as u where g.uplID=u.uplID
		order by time DESC limit $start,$portion");
// ----------------------------------------------------------------------------/
?>

<div class=head>&nbsp; Images in Gallery (<?= $num_rows ?>):</div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<?= $hbar ?>
<div class='txt'><?= $lbar ?></div>

<table border=0 cellspacing=0 cellpadding=1 class="border">
<tr><td>
<table border=0 cellspacing=1 cellpadding=2>

<tr valign=baseline class="bgH">
  <td class="txtB" align=center nowrap>#</td>
  <td class="txtB" align=center nowrap>Time</td>
  <td class="txtB" nowrap>Image File</td>
  <td class="txtB">Notes</td>
  <td class="txtB"><a href='./'>Add</a></td>
</tr>

<?
  $max_l=150;
  for ($i=$start+1; $row=@$sql_fetch_assoc($res); $i++) {
    $time=site_date($TIME_FMT,$row['time']);
    $fname="$row[path]/$row[name]";
    $w=min($max_l,$wr=$row['width']);
    $h=min($max_l,$hr=$row['height']);
    $comm=to_html($row['comment']);
    $altt=to_html($row['alt'])." [$wr x $hr]";
    $class=($ID==$row['imgID']) ? 'bgHl' : 'bg';
    echo "<tr valign=baseline class=$class>
	<td align=right class=txtB>$i&nbsp;</td>
	<td class=f1>$time</td>
	<td class=txtB><a href='$SITE_ROOT/$fname' target=_blank>$row[name]<br>
		<img src='$SITE_ROOT/$fname' width=$w height=$h border=0 vspace=3 alt='$altt'></a></td>
	<td>$comm</td>
	<td class=txtB>
		<a href='./?ID=$row[imgID]&page=$page'>Edit</a><br>
		<img src='$SITE_ROOT/img/1x1b.gif' width=95% height=1 vspace=2 alt=''><br>
		<a href='delete.php?ID=$row[imgID]&page=$page'
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
  $DBdata=($ID && !$Repeat);
  if ($DBdata) @extract(@$sql_fetch_assoc(db_query(
		"select time,uplID,comment,alt from site_gallery where imgID=$ID")));

  call('to_html',call('chop',array(&$comment,&$alt)));
  $uplID=(int)$uplID;
// ----------------------------------------------------------------------------/
?>

<script language=javascript><!--
function checkUpdate(f) {
    if (! self.allLoaded) return errorNotAllLoaded()
  if (<?= $ID ?>==0 && !f.upl.value.length) {
    alert('Choose image file')
    f.upl.focus()
    return false
    }
  }
//-->
</script>

<form name="update" action="update.php?ID=<?= $ID ?>&page=<?= $page ?>#edit" 
	method=post enctype=multipart/form-data
	onSubmit="return formSubmitOnce(this,checkUpdate(this))">

<div class=head>&nbsp; <?= (!$ID) ? 'Add New Image' : 'Edit Image' ?></div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<?
  $star='<span class=star>*</span>';
?>
- Fields marked by <?= $star ?> are required.<br>
- Image may be JPEG, GIF or PNG
  <?= $MAX_UPLOAD_FILESIZE ? " and up to $MAX_UPLOAD_FILESIZE KB" : "" ?>.<br>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<table border=0 cellspacing=0 cellpadding=1 class="border">
<tr><td>
<table border=0 cellspacing=1 cellpadding=2>

<tr valign=middle class="bgH">
  <td class="txtB" nowrap><?= $star ?> Image File:</td>
  <td class="bg">
    <input type=hidden name="uplID" value="<?= $uplID ?>">
    <? if ($uplID) { ?>
    <?= file_image($uplID,'hspace=5 vspace=5') ?><br>
    <? } ?><input type=file name="upl">
  </td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt">Notes:</td>
  <td class="bg" nowrap><input type=text name="comment" size=32 maxlength=50 value="<?= $comment ?>"></td>
</tr>
<tr valign=baseline class="bgH">
  <td class="txt" nowrap>Alt-Signature:</td>
  <td class="bg"><input type=text name="alt" size=32 maxlength=50 value="<?= $alt ?>"></td>
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
