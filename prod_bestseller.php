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
$pages_url="$SITE_ROOT/prod_bestseller_<page>.html";
//-------------------------------------\
$ModuleData=array(
	'page' => $page,
	'pages_url' => $pages_url,
	'head_title' => 'Bestsellers',
	'show_desc' => 1,
	'condition' => '',
	'order' => 'p.num_choosed desc'
	);
include('modules/products_search.php');
//-------------------------------------/
?>



<?
  include_once("$ROOT_PATH/common/all_tail.php");
?>
