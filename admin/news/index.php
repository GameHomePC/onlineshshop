<?
// ====================================\
  @include_once('_dir.php');
  $TITLE="News Management";
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
  }
//-->
</script>

<table border=0 cellspacing=0 cellpadding=1>
<tr><td class="border">
<table border=0 cellspacing=1 cellpadding=2>

<form action='update_group.php' method=post
	onSubmit='return formSubmitOnce(this,checkUpdateG(this))'>

<tr valign=baseline class="bgH">
  <!--<td class="txtB" align=center>Archive</td>-->
  <td class="txtB" width=90 align=center nowrap>Date</td>
  <td class="txtB" width=500 nowrap>News</td>
  <td class="txtB"><a href='view.php'>Add</a></td>
</tr>

<?
  $res=db_query("select nwsID,archive,time,title,content,source from news order by time DESC,nwsID DESC");

  while ($row=@$sql_fetch_assoc($res)) {
    @extract($row);
    $time=get_date_str($time);
    $title=to_html($title);
    $content=str_replace('<%BASE%>',$SITE_ROOT,$content);
    if ($source!='') $source="<a target=_blank href='$source'>Source</a>";
    $checked='';
    if ($archive) {
      $checked='checked';
      $time="<span class=inactive>$time</span>";
      $title="<span class=inactive>$title</span>";
      $content="<span class=inactive>$content</span>";
      }
    echo "<tr valign=baseline class=bg>
	<!--<td class=bgH align=center><input type=checkbox name='archive[]' value='$nwsID' $checked></td>-->
	<td align=center class=txtB>$time</td>
	<td class=txt width=500><p><span class=txtB>$title</span><br>
		<img src='$SITE_ROOT/img/1x1.gif' width=1 height=5 alt=''><br>
		$content<br>
		<img src='$SITE_ROOT/img/1x1.gif' width=1 height=5 alt=''><br>
		$source</p></td>
	<td class=txtB>
		<a href='view.php?ID=$nwsID'>Edit</a><br>
		<img src='$SITE_ROOT/img/1x1b.gif' width=95% height=1 vspace=2 alt=''><br>
		<a href='delete.php?ID=$nwsID'
		onClick='return makeSure()'>Delete</a></td>
	</tr>";
    }
?>

<!--
<tr class="bg">
  <td class="bgH"><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=7 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=5 alt=''></td>
</tr>
<tr class="bg">
  <td colspan=2 align=center class="bgH"><input class=buttonH type=submit value="Submit >>"></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=1 alt=''></td>
  <td><img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=1 alt=''></td>
</tr>
-->

</form>

</table>
</td></tr>
</table>



<?
  include_once("$ROOT_PATH/$ADMIN_DIR/common/logged_tail.php");
?>
