<?


//ini_set('display_errors', 1);
// ====================================\
  @include_once('_dir.php');
// ====================================/

  $IsHomePage=1;
  include_once("$ROOT_PATH/common/all_head.php");
?>


<?
 if ($tmp=$FIRST_PAGE_PRODS_INIT[$Config['first_page_prods']]) {
//=================================================================\
?>

<hr width=100% noshade size=1 color=#E5E3E3 align=left>

<?
// ------------------------------------\
list($page)=$args;
call('intval',array(&$page));

$ModuleData=array(
	'page' => $page,
	'pages_url' => "$SITE_ROOT/index_<page>.html",
	'head_title' => $tmp['title'],
	'condition' => $tmp['condition'],
	'order' => $tmp['order'],
	'rand' => $tmp['rand'],
	'show_desc' => 1
	);

include('modules/products_search.php');
//-------------------------------------/
?>
<?
//=================================================================/
  }
?>



<?
  include_once("$ROOT_PATH/common/all_tail.php");
?>
