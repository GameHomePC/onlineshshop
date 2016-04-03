<?
// ====================================\
  @include_once('_dir.php');
// ====================================/


// ------------------------------------\
  $page=(int)$args[0];
  if ($page<0) $page=0;
// ------------------------------------/


  include_once("$ROOT_PATH/common/all_head.php");
?>


<?
$pages_url="$SITE_ROOT/prod_featured_<page>.html";
//-------------------------------------\
$ModuleData=array(
	'page' => $page,
	'pages_url' => $pages_url,
	'head_title' => 'Featured Products',
	'show_desc' => 1,
	'condition' => "((p.price_type=2 and spec_time1<=$TIME and
			(!spec_time2 or spec_time2>=$TIME)) or pn.price_type=2)",
	'order' => ''
	);
include('modules/products_search.php');
//-------------------------------------/
?>



<?
  include_once("$ROOT_PATH/common/all_tail.php");
?>
