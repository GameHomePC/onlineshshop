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
  $portion=(int)$Config['num_news'];
  $num_rows=@$sql_result(db_query("select count(*) from news"),0,0);
  $page=(int)$page;

  list($hbar,$lbar,$page)=make_page_bar("news_",$num_rows,$page,1,0,$portion);
  $lbar=preg_replace('/news_\d+/','\0.html',$lbar);

  $start=$page*$portion;

  $res=db_query("select nwsID,time,title,content,source
		from news order by time DESC,nwsID DESC limit $start,$portion");
// ----------------------------------------------------------------------------/
?>


<?= $hbar ?>
<div class='txt'><?= $lbar ?></div>

<br>
<?
  $ml=150;
  while ($row=@$sql_fetch_assoc($res)) {
    @extract($row);
    $time=get_date_str($time);
    $title=to_html($title);
    $content=strip_tags(str_replace('<%BASE%>',$SITE_ROOT,$content));
    if (strlen($content)>$ml) $content=substr($content,0,$ml).'...';
    echo "<a name='$nwsID'></a>
	<div class=head><a href='news_view_$nwsID.html'>[$time] $title</a></div>
	$content<br><br>";
    }
?>

<div class='txt'><?= $lbar ?></div>
<?= $hbar ?>


<?
  include_once("$ROOT_PATH/common/all_tail.php");
?>
