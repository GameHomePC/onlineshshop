<?php
//ini_set('display_errors', 1);
// ====================================\
@include_once('_dir.php');
// ====================================/

$IsHomePage = 1;
include_once("$ROOT_PATH/common/all_head.php");
?>


<?php
    if ($tmp = $FIRST_PAGE_PRODS_INIT[$Config['first_page_prods']]) {
?>


<ul class="decorLink">
    <li><a href='<?php echo $SITE_ROOT ?>/prod_special.html'>Specials</a></li>
    <li><a href='<?php echo $SITE_ROOT ?>/prod_new.html'>New Products</a></li>
    <li><a href='<?php echo $SITE_ROOT ?>/prod_featured.html'>Featured Products</a></li>
    <li><a href='<?php echo $SITE_ROOT ?>/prod_bestseller.html'>Bestsellers</a></li>
</ul>

<?php
    list($page) = $args;
    call('intval', array(&$page));

    $ModuleData = array(
        'page' => $page,
        'pages_url' => "$SITE_ROOT/index_<page>.html",
        'head_title' => $tmp['title'],
        'condition' => $tmp['condition'],
        'order' => $tmp['order'],
        'rand' => $tmp['rand'],
        'show_desc' => 1
    );

    include('modules/products_search.php');
}
?>

<?php
include_once("$ROOT_PATH/common/all_tail.php");
?>
