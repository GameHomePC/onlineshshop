<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

// ------------------------------------\
  $page=(int)$args[0];
// ------------------------------------/

  include_once("$ROOT_PATH/common/all_head.php");
?>



<?
// ----------------------------------------------------------------------------\
  $portion=(int)$Config['num_articles'];
  $num_rows=@$sql_result(db_query("select count(*) from site_pages where type=2 and active"),0,0);
  $page=(int)$page;

  list($hbar,$lbar,$page)=make_page_bar("articles_",$num_rows,$page,1,0,$portion);
  $lbar=preg_replace('/(articles_\d+)/','\1.html',$lbar);

  $start=$page*$portion;
  $res=db_query("select pageID,title,content1 as content,
			IF(url_name!='',url_name,pageID) as url_name
		from site_pages where type=2 and active
		order by priority,pageID limit $start,$portion");
// ----------------------------------------------------------------------------/
?>


<?= $hbar ?>
<div class='txt'><?= $lbar ?></div>

<br>
<table border=0 cellspacing=0 cellpadding=0>
<?
  while ($row=@$sql_fetch_assoc($res)) {
    @extract($row);
    $url="$SITE_ROOT/page_$url_name.html";
    $title=to_html($title);
    $content=substr(strip_tags(str_replace('<%BASE%>',$SITE_ROOT,$content)),0,400);
    echo "<tr><td colspan=2 class=head><a href='$url'>$title</a></td></tr>
	<tr><td width=15></td><td><p>$content... &nbsp;
		<a href='$url'>More...&nbsp;&gt;&gt;</a></p></td></tr>
	<tr><td>&nbsp;</td></tr>";
    }
?>
</table>

<div class='txt'><?= $lbar ?></div>
<?= $hbar ?>



<?
  include_once("$ROOT_PATH/common/all_tail.php");
?>
