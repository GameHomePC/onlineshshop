<?void();

  if ($PageData['content2']!='')
    echo '<br>',str_replace('<%BASE%>',$SITE_ROOT,$PageData['content2']),'<br>';
?>

<?
/*
// ------------------------------------\
  $res=db_query("select pageID,type,static_page,title,
			IF(url_name!='',url_name,pageID) as url_name
		from site_pages
		where (type<2 or active) and
			LOCATE(CONCAT(':',pageID,':'),'$PageData[bottom_links]')>0
		order by type,priority,pageID");
  for ($t='<br>'; $row=@$sql_fetch_assoc($res); $t='') {
    @extract($row);
    $uri=make_url($static_page,$url_name,$type);
    $title=to_html($title);
    echo "$t<a href='$uri'>$title</a><br>";
    }
// ------------------------------------/
*/
?>

<?
  if ($PageData['type']==2) {
// ----------------------------------------------------------------------------\
  $tmp_pr=$PageData['priority'];
  $tmp_id=$PageData['pageID'];
  $prevID=$nextID=0;
  list($prevID,$prev_title,$prev_url_name)=@$sql_fetch_row(db_query("select pageID,title,IF(url_name!='',url_name,pageID) as url_name from site_pages where type=2 and active and (priority<$tmp_pr or (priority=$tmp_pr and pageID<$tmp_id)) order by priority DESC,pageID DESC limit 1"));
  list($nextID,$next_title,$next_url_name)=@$sql_fetch_row(db_query("select pageID,title,IF(url_name!='',url_name,pageID) as url_name from site_pages where type=2 and active and (priority>$tmp_pr or (priority=$tmp_pr and pageID>$tmp_id)) order by priority,pageID limit 1"));
  call('to_html',array(&$prev_title,&$next_title));
?>
<br>
<table border=0 cellspacing=0 cellpadding=2 width=100%>
<tr valign=top>
  <td width=50% align=right class=txtB>
<?
  if ($prevID) echo "<a href='$SITE_ROOT/page_$prev_url_name.html' title='<<Previous'>$prev_title</a>";
?>
  </td>
  <td width=0>|</td>
  <td width=0 class=txtB nowrap><a href='articles.html'>Articles Index</a></td>
  <td width=0>|</td>
  <td width=50% align=left class=txtB>
<?
  if ($nextID) echo "<a href='$SITE_ROOT/page_$next_url_name.html' title='Next>>'>$next_title</a>";
?>
</td>
</tr>
</table>
<?  
// ----------------------------------------------------------------------------/
    }
?>

<?= $Config['signature'] ? '<br><br>'.str_replace('<%BASE%>',$SITE_ROOT,$Config['signature']) : '' ?>

<?
// ------------------------------------\
  include_once("$ROOT_PATH/common/_tail.php");
// ------------------------------------/
?>

<a name="t"></a>

<script language=javascript><!--
var allLoaded=1
//-->
</script>

</body>
</html>

<?
//_fix_time('END',1);
?>