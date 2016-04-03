<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

  include_once("$ROOT_PATH/common/all_head.php");
?>



<?
  $AllPages=array();
  $res=db_query("select	pageID,type,static_page,title,bottom_links,
			IF(url_name!='',url_name,pageID) as url_name
		from site_pages
		where type<2 and active and in_map order by type,pageID");
  while ($row=@$sql_fetch_assoc($res)) {
    $pageID=$row['pageID'];
    $row['title']=to_html($row['title']);
    $row['href']=make_url($row['static_page'],$row['url_name'],$row['type']);
    $row['bottom_links']=call('intval',explode(':',$row['bottom_links']));
    $AllPages[$pageID]=$row;
    }

  $Pages=$AllPages;
//  foreach ($MenuItems as $item)
//    if ($item['level']) unset($Pages[$item['pageID']]);


  $Space=str_repeat('&nbsp;',6);

// ------------------------------------\
function write_subpages($list,$prefix='',$suffix='') {
    global $AllPages,$Pages,$Space;
  foreach ($list as $id)
    if ($page=$Pages[$id]) {
      echo "$prefix<a href='$page[href]'>$page[title]</a>$suffix<br>";
      unset($Pages[$id]);
      write_subpages($AllPages[$id]['bottom_links'],"$prefix$Space");
      }
  }
// ------------------------------------/
/*
  foreach ($MenuItems as $item) {
    $l=$item['level'];
    if (!$l) continue;
    $pageID=$item['pageID'];
    $title=to_html($item['menu_title']);
    $lattrs=$item['newwin'] ? 'target=_blank' : '';
    if ($item['href']) $title="<a href='$item[href]' $lattrs>$title</a>";
    $title=($l==1) ? 
	"<img src='$SITE_ROOT/img/1x1.gif' width=1 height=5 alt=''><br>
			<div class=head>&#149; $title</div>" :
	"$title<br>";
    $prefix=str_repeat($Space,$l-1);
    echo "$prefix$title";
    if ($pageID) write_subpages($AllPages[$pageID]['bottom_links'],"$prefix$Space");
    }
*/
  echo "<br>";
  $list=array_keys($Pages);
  write_subpages($list,'<li><b>','</b>');

// ------------------------------------|

  $T=$TIME-(int)$Config['num_days_new']*86400;

  echo "<br><div class=headH>&#149; <u>Catalog</u></div>
	<ul style='margin-top:5;'>";
  $lt=0;
  foreach ($CategItems as $id=>$item) {
//    if ($id<2 || !$item['n_prod'] || !$item['active_info']) continue;
    if ($id<2) continue;
    $l=$item['level']-1;
    list($name,$comm)=call('to_html',$item['name'],$item['comment']);
    if ($l>$lt) echo '<ul>';
    elseif ($lt>$l) echo str_repeat('</ul>',$lt-$l);
    $cl=$l ? 'txt' : 'txtB';
    $img=($item['has_new'] || $item['last_time']>$T) ? $ImgNew : '';
    $ch=strlen($comm) ? ' - ' : '';

    echo "<li><a class=$cl href='$SITE_ROOT/$item[href]'>$name</a> ($item[n_prod])$img
	$ch<small>$comm</small><br>
	<img src='$SITE_ROOT/img/1x1.gif' width=1 height=3 alt=''>";
    $lt=$l;
    }
  echo '</ul>';
?>



<?
  include_once("$ROOT_PATH/common/all_tail.php");
?>
