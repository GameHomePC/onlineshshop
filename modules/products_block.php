<?php
void();
//--------------------\
// INPUT:
// $ModuleData[
//	"header"
//	"condition"
//	"order"
//	"block_head"
//	"block_tail"
//	]
//--------------------/

$resOne = db_query("select p.prdID as prdID,p.priority as priority,url_name,
		IF(pn.name!='',pn.name,p.name) as name,cp.catID as catID,
		IF(attributes!='',1,0) as attributed,
		p.price_type as price_type,price,spec_price,spec_time1,spec_time2,
		pn.price_type as price_type_new
	from (sc_product as p,sc_category_prod as cp)
	  left join sc_product_newval as pn on pn.prdID=p.prdID
	where p.active and p.in_stock and cp.catID in ($CategItemsActKeys) and
		time_available<=$TIME and
		cp.prdID=p.prdID" . ($ModuleData['condition'] ? " and $ModuleData[condition]" : '') .
    " group by p.prdID" .
    ($ModuleData['order'] ? " order by $ModuleData[order]" : '') .
    " limit $Config[num_products_feat]");
if (!@$sql_num_rows($resOne)) return;

?>

<?php
    while ($row = @$sql_fetch_assoc($resOne)) {
        list(, $price_str) = make_prd_price($row['price'], $row['price_type'], $row['spec_price'], $row['spec_time1'], $row['spec_time2'], $row['price_type_new']);
        $price_str = '$' . $price_str;
        $url = make_prd_url($row['catID'], $row['prdID'], $row['url_name'], $row['name']);
        $url1 = $row['attributed'] ? "$SITE_ROOT/$url" : make_buy_url($row['prdID']);

        echo '<li>',
        ($Config['show_add_but'] ? "<a class='boxList__buy' href='$url1' rel=nofollow><img src='$SITE_ROOT/img/buttons/addtocart.gif' width=16 height=16 alt='Add to Cart' align=absmiddle></a>" : ''),
        "<a class='boxList__link' href='$SITE_ROOT/$url' title='View Product'>$row[name]&nbsp;-&nbsp;$price_str</a></li>";
    }
?>


<?php echo $ModuleData['block_tail']; ?>
