<?
@include_once('_dir.php');

include_once("$ROOT_PATH/common/all_head.php");
?>

<?
$search_text = trim($search_text);
$s_any_word = $s_any_word ? 1 : 0;

$s_catID = (int)$s_catID;
list($cat_sel, $s_catID) = create_select('s_catID', $CategItems, $s_catID, 0, 'makeCategItemOption2', 0, 0, 1, '', '<option value=0>--- Any ---</option>');
$s_catID = (int)$s_catID;

$min_price = (double)$min_price;
if ($min_price < 0) $min_price = 0;
$max_price = (double)$max_price;
if ($max_price < 0) $max_price = 0;
if ($max_price && $max_price < $min_price) $min_price = 0;
$condition = '';
$tmp = array();
if ($min_price)
    $tmp[] = "IF((p.price_type and spec_time1<=$TIME and
		(!spec_time2 or spec_time2>=$TIME) and p.spec_price),
	p.spec_price,p.price)>=$min_price";
if ($max_price)
    $tmp[] = "IF((p.price_type and spec_time1<=$TIME and
		(!spec_time2 or spec_time2>=$TIME) and p.spec_price),
	p.spec_price,p.price)<=$max_price";
if ($tmp) $condition = implode(' and ', $tmp);
?>



<?
//-------------------------------------\
$tmp = array();
if ($s_catID) $tmp[] = "s_catID=$s_catID";
if ($min_price) $tmp[] = "min_price=$min_price";
if ($max_price) $tmp[] = "max_price=$max_price";
if ($s_any_word) $tmp[] = 's_any_word=1';
$ModuleData = array(
    'page' => (int)$args[0],
    'pages_url' => 'search_prod_<page>.html' . ($tmp ? '?' . implode('&', $tmp) : ''),
    'head_title' => 'Search result',
    'catID' => $s_catID,
    'condition' => $condition,
    'search_text' => $search_text,
    'any_word' => $s_any_word ? 1 : 0,
    'show_desc' => 1
);

include('modules/products_search.php');
//-------------------------------------/
?>


<?
include_once("$ROOT_PATH/common/all_tail.php");
?>
