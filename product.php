<?php
@include_once('_dir.php');

$PrdID = (int)$args[0];
$url_name = trim(trim($url_name), '/');
$cat_url_name = trim(trim($cat_url_name), '/');

$ActiveCatsOnly = 1;
include_once("$ROOT_PATH/modules/sc_category.php");

if ($url_name != '') {
    if (check_int($url_name)) {
        $PrdID = (int)$url_name;
        $url_name = '';
    } elseif ($Config['prd_name_to_url'] &&
        ($n = sizeof($tmp = explode('-', $url_name))) > 1 &&
        $tmp[$n - 1][0] == 'p' &&
        check_int($a = @substr($tmp[$n - 1], 1))
    ) {
        $PrdID = (int)$a;
        $url_name = '';
    }
}

$cond = 0;
if ($url_name != '')
    $cond = "pn.url_name='" . to_sql($url_name) . "'";
elseif ($PrdID)
    $cond = "p.prdID=$PrdID";

if ($cond && $cat_url_name != '')
    if ($c_id = $CategUrlToID[$cat_url_name])
        $cond .= " and cp.catID=$c_id";
    else $cond = 0;

if ($cond) {
    if (!$view_inactive)
        $cond .= " and p.active and cp.catID in ($CategItemsActKeys)";

    $Product = @$sql_fetch_assoc(db_query(
        "select p.prdID as prdID,cp.catID as catID,
		in_stock,attributes,quantity as max_quantity,
		p.price_type as price_type,price,spec_price,spec_time1,spec_time2,
		pn.price_type as price_type_new,
		opt1,price1,spec_price1,
		opt2,price2,spec_price2,
#		pn.url_name as url_name,

		IF(pn.name!='',pn.name,p.name) as name,
		IF(pn.comment!='',pn.comment,p.comment) as comment,
		IF(pn.description!='',pn.description,p.description) as description,
		IF(pn.meta_title!='',pn.meta_title,p.meta_title) as meta_title,
		IF(pn.meta_keywords!='',pn.meta_keywords,p.meta_keywords) as meta_keywords,
		IF(pn.meta_description!='',pn.meta_description,p.meta_description) as meta_description,

		IF(u1.uplID,u1.uplID,0) as uplID1,
		IF(u2.uplID,u2.uplID,0) as uplID2,
		IF(u3.uplID,u3.uplID,0) as uplID3,
		IF(u1.img_not_loaded,u1.name,CONCAT(u1.path,'/',u1.name)) as fname1,
		IF(u2.img_not_loaded,u2.name,CONCAT(u2.path,'/',u2.name)) as fname2,
		IF(u3.img_not_loaded,u3.name,CONCAT(u3.path,'/',u3.name)) as fname3,
		u1.width as width1,u1.height as height1,
		u2.width as width2,u2.height as height2,
		u3.width as width3,u3.height as height3,
		u1.img_not_loaded as img_not_loaded1,
		u2.img_not_loaded as img_not_loaded2,
		u3.img_not_loaded as img_not_loaded3,

		IF(m.mnfID,m.mnfID,0) as mnfID,
		IF(mn.url_name!='',mn.url_name,m.mnfID) as mnf_url_name,
		IF(mn.name!='',mn.name,m.name) as mnf_name
	from (sc_product as p,sc_category_prod as cp)
	  left join sc_product_newval as pn on pn.prdID=p.prdID
	  left join uploads1 as u1 on uplID1=u1.uplID
	  left join uploads1 as u2 on uplID2=u2.uplID
	  left join uploads1 as u3 on uplID3=u3.uplID
	  left join sc_manufacturer as m on p.mnfID=m.mnfID
	  left join sc_manufacturer_newval as mn on mn.mnfID=m.mnfID
	where $cond and cp.prdID=p.prdID and time_available<=$TIME
	limit 1"));
    $PrdID = $Product['prdID'];
    $CatID = $Product['catID'];
}

if (!$cond || !$PrdID)
    $RedirectUrl = "$SITE_ROOT/";
else {
    $PageTitle = $Product['name'];
    if ($Product['description'] == '') $Product['description'] = $Product['comment'];
    $Meta['title'] = $Product['meta_title'] ? $Product['meta_title'] : $Product['name'];
    $Meta['keywords'] = $Product['meta_keywords'] ? $Product['meta_keywords'] : $Product['name'];
    $Meta['description'] = $Product['meta_description'] ? $Product['meta_description'] :
        ($Product['comment'] ? $Product['comment'] : $Product['name']);
}

include_once("$ROOT_PATH/common/all_head.php");
?>



<?php
extract($Product);

list($spec, $price_str, $old_price_str) =
    make_prd_price($price, $price_type, $spec_price, $spec_time1, $spec_time2, $price_type_new);

if($old_price_str) {
    $price_str = '<span class="old">$' . $old_price_str . '</span><span class="new">$' . $price_str . '</span>';
} else {
    $price_str = '$' . $price_str;
}

$Product['Special'] = $spec ? 1 : 0;

$tmp = array();
if ($opt2) $tmp[$opt2] = (($spec && $spec_price) ? $spec_price2 : $price2);
if ($opt1) $tmp[$opt1] = (($spec && $spec_price) ? $spec_price1 : $price1);
$tmp[1] = (($spec && $spec_price) ? $spec_price : $price);
$Product['Pricing'] = $tmp;

if (!is_array($attributes = @unserialize($attributes))) $attributes = array();
$Product['attributes'] = $attributes;

$quantity = (int)$quantity;
if ($quantity < 1) $quantity = 1;




foreach ($tmp as $opt => $price)
    if ($quantity >= $opt && $price) break;
$Product['Price'] = $price;

if ($attributes && $in_stock && $max_quantity)
    $form = '<br>' .
        ($INCLUDE_PRODUCT_FORM_FROM_SHOPXML ?
            _LOAD_DATA("$SC_SITE_URL/EXPORT/product.php?shop=$SHOP_ID&product=$PrdID&template=FORM&quantity=$quantity&new_order_url=" . to_url("$SITE_ROOT/buy.html?continueCat=$CatID")) :
            make_form($Product, 0, $quantity, $max_quantity, $CatID));
else $form = '';

$W = 400;
$H = 400;
$width = $height = 0;

$show_big_img = $uplID3 && ($Config['img_prd_big'] || (!$uplID2 && !$uplID1));

$image = '';
if ($show_big_img) {
    $image = $img_not_loaded3 ? $fname3 : "$SITE_ROOT/$fname3";
    $width = $width3;
    $height = $height3;
} elseif ($uplID2) {
    $image = $img_not_loaded2 ? $fname2 : "$SITE_ROOT/$fname2";
    $width = $width2;
    $height = $height2;
} elseif ($uplID1) {
    $image = $img_not_loaded1 ? $fname1 : "$SITE_ROOT/$fname1";
    $width = $width1;
    $height = $height1;
}

if ($width > $W) {
    $height = (int)($height * $W / $width);
    $width = $W;
}
if ($height > $H) {
    $width = (int)($width * $H / $height);
    $height = $H;
}
if (($uplID1 || $uplID2 || $uplID3) && (!$width || !$height)) {
    $width = 200;
    $height = 200;
}

if ($image) {
    $image = "<img src='$image' width=$width height=$height alt='" . to_html($name) . "'" .
        (($uplID3 && !$show_big_img) ? " title='Enlarge'" : '') .
        ">";
    if ($uplID3 && !$show_big_img) {
        $img_url = ($img_not_loaded3 ? '' : "$SITE_ROOT/") . $fname3;
        $image = "<a href='$img_url' target=_blank
		onclick='makePullDown(\"$img_url\",\"img$uplID3\",$width3+20,$height3+20,1);return false'>$image</a>";
    }
}
?>


<div class="product">
    <div class="product__images">
        <div class="product__imagesLink">
            <?php echo $image; ?>
        </div>

        <div class="product__price">
            <?php echo $price_str; ?>
        </div>

        <?php if ($in_stock && $max_quantity) { ?>
            <?php if (!$Product['attributes']) { ?>
                <div class="product__btn">
                    <a class="btn btn__blue" href="<?php echo make_buy_url($prdID, $CatID) ?>" rel='nofollow'>
                        Buy Now!
                    </a>
                </div>
            <?php }
        } else { ?>
            <div class="product__btn">
                <span class="btn btn__blue">OUT</span>
            </div>
        <?php } ?>

    </div>

    <div class="product__content">
        <?php echo
            (($mnfID) ? "<div align='right'><span class='button3'>Manufacturer: <a href='$SITE_ROOT/manufacturer_$mnf_url_name.html'>$mnf_name</a></span></div>" : ''),
            (($description != '') ? '<div class="product__description">' . $description . '</div>' : ''),
            $form
        ?>
    </div>
</div>

<div class="product__relative">Related Products</div>

<?php
    if ($Config['show_related_prds']) {
        $ModuleData = array(
            'page' => 0,
            'pages_url' => '',
            'head_title' => 'RELATED PRODUCTS',
            'catID' => $CatID, // 0
            'condition' => "price>$Product[price]",
            'search_text' => $Product['name'],
            'any_word' => 1,
            'cols' => 0,
            'rows' => 2,
            'rand' => 1,
            'show_desc' => 1
        );

        include('modules/products_search.php');
    }
?>

<?php
    include_once("$ROOT_PATH/common/all_tail.php");
?>
