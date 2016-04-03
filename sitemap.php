<?
// ====================================\
  @include_once('_dir.php');
// ====================================/


header('Content-type: text/xml; charset=utf-8');

$Date_format='Y-m-d';
$Def_last_mod=site_date($Date_format,mktime(1,0,0,6,1,2005));

// --------------------------------------------------\
  include_once("$ROOT_PATH/modules/sc_category.php");
// --------------------------------------------------/

echo '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.google.com/schemas/sitemap/0.84">';


//-------------------------------------------------------------------<

$res=db_query("select p.prdID as prdID,url_name,
		IF(pn.name!='',pn.name,p.name) as name,cp.catID as catID,
		IF((pn.prdID and pn.last_modified>p.last_modified),pn.last_modified,p.last_modified) as last_modified
	from (sc_product as p,sc_category_prod as cp)
		left join sc_product_newval as pn on pn.prdID=p.prdID
	where p.active and p.in_stock and cp.catID in ($CategItemsActKeys) and
		time_available<=$TIME and
		cp.prdID=p.prdID
	group by p.prdID");

while ($row=@$sql_fetch_assoc($res)) {
  $url=make_prd_url($row['catID'],$row['prdID'],$row['url_name'],$row['name']);
  $date=$row['last_modified'] ? site_date($Date_format,$row['last_modified']) : $Def_last_mod;
  echo "<url><loc>$URL_HEADER/$url</loc><lastmod>$date</lastmod></url>";
  }

//-------------------------------------------------------------------<

$date=site_date($Date_format,$TIME);
foreach ($CategItemsA as $id=>$item) {
  $url=$item['href'];
  echo "<url><loc>$URL_HEADER/$url</loc><lastmod>$date</lastmod></url>";
  }

//-------------------------------------------------------------------<

$IsNews=$IsStories=0;

$res=db_query("select pageID,type,static_page,
			IF(url_name!='',url_name,pageID) as url_name,
			last_modified
		from site_pages
		where active and (in_map or type=2)");
while ($row=@$sql_fetch_assoc($res)) {
  if (!$row['type'])
    if ($row['static_page']=='news.php') $IsNews=1;
    elseif ($row['static_page']=='stories.php') $IsStories=1;

  $url=make_url($row['static_page'],$row['url_name'],$row['type'],'',$URL_HEADER);
  $date=$row['last_modified'] ? site_date($Date_format,$row['last_modified']) : $Def_last_mod;
  echo "<url><loc>$url</loc><lastmod>$date</lastmod></url>";
  }

//-------------------------------------------------------------------<

if ($IsNews && @$sql_num_rows(db_query("select 1 from site_pages
		where active and !type and static_page='news_view.php'"))) {
  $res=db_query("select nwsID,time from news");
  while ($row=@$sql_fetch_assoc($res)) {
    $date=$row['time'] ? site_date($Date_format,$row['time']) : $Def_last_mod;
    echo "<url><loc>$URL_HEADER/news_view_$row[nwsID].html</loc><lastmod>$date</lastmod></url>";
    }
  }

//-------------------------------------------------------------------<

if ($IsStories && @$sql_num_rows(db_query("select 1 from site_pages
		where active and !type and static_page='story.php'"))) {
  $res=db_query("select strID from stories where active");
  while ($row=@$sql_fetch_assoc($res)) {
    echo "<url><loc>$URL_HEADER/story_$row[strID].html</loc><lastmod>$Def_last_mod</lastmod></url>";
    }
  }

//-------------------------------------------------------------------<


echo '</urlset>';

?>