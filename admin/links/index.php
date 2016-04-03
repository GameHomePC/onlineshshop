<?
// ====================================\
  @include_once('_dir.php');
  $TITLE="Partners/Links";
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_head.php");
?>



<?
// ------------------------------------\
  report_ok($OK);
// ------------------------------------/
?>


<script language=javascript><!--
function checkUpdateG(f) {
    if (! self.allLoaded) return errorNotAllLoaded()
  var els=f.elements
  var l=els.length
  for (var i=0; i<l; i++) {
    var el=els[i]
    if (el.name.indexOf('priority')==0 && el.value.length && checkInt(el.value)==null) {
      alert('Wrong value for order')
      el.focus()
      el.select()
      return false
      }
    }
  }
//-->
</script>

<div class=head>&nbsp; Existing Links:</div>
<img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''><br>

<table border=0 cellspacing=0 cellpadding=1>
<tr><td class="border">
<table border=0 cellspacing=1 cellpadding=2>

<form action='update_group.php' method=post
  onSubmit='return formSubmitOnce(this,checkUpdateG(this))'>

<tr valign=baseline class="bgH">
  <td class="txtB" align=center>Visible</td>
  <td class="txtB" align=center>Order<br>
	<div style='font-weight:normal'>(0-255)</div></td>
  <td class="txtB" width=90 align=center nowrap>Image</td>
  <td class="txtB" width=320 nowrap>Content</td>
  <td class="txtB"><a href='view.php'>Add</a></td>
</tr>

<?
  $res=db_query("select lnkID,active,l.uplID as uplID,priority,l.name as name,url,content,
			CONCAT(path,'/',u.name) as fname
		from links as l left join uploads as u on l.uplID=u.uplID
		order by priority,lnkID DESC");
  $num_rows=@$sql_num_rows($res);
  while ($row=@$sql_fetch_assoc($res)) {
    @extract($row);
    $img='&nbsp;';
    if ($uplID) {
      $attrs=get_elem(@getimagesize("$SERVER_ROOT/$fname"),3);
      $img="<img src='$SITE_ROOT/$fname' $attrs border=0 align=top alt=''>";
      }
    call('to_html',array(&$name,&$url));
    if ($url!='') $name="<a href='$url' target=_blank>$name</a>";
    $content=substr(strip_tags(str_replace('<%BASE%>',$SITE_ROOT,$content)),0,200);
    $checked='checked';
    if (!$active) {
      $checked='';
      $content="<span class=inactive>$content</span>";
      }
    echo "<tr valign=top class=bg>
	<td class=bgH align=center><input type=checkbox name='active[$lnkID]' value='1' $checked></td>
	<td class=bgH align=center><input type=text name='priority[$lnkID]' size=3 maxlength=5 value='$priority'></td>
	<td align=center valign=top>$img</td>
	<td class=txt width=320><div class=txtB>$name</div>
		<img src='$SITE_ROOT/img/1x1.gif' width=1 height=5 alt=''><br>
		$content...</td>
	<td class=txtB>
		<a href='view.php?ID=$lnkID'>Edit</a><br>
		<img src='$SITE_ROOT/img/1x1b.gif' width=95% height=1 vspace=2 alt=''><br>
		<a href='delete.php?ID=$lnkID'
		onClick='return makeSure()'>Delete</a></td>
	</tr>";
    }
?>

<? if ($num_rows) { ?>
<tr class="bg">
  <td colspan=2 class="bgH"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=7 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>
<tr class="bg">
  <td colspan=2 align=center class="bgH"><input class=buttonH type=submit value="Submit >>"></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=1 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=1 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>
<? } ?>

</form>

</table>
</td></tr>
</table>



<?
  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_tail.php");
?>
