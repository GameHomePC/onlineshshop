<? void(); ?>

</td>
<td width=0>

    <?
    //-----------------------------------------------\
    $ModuleData = array(
        'header' => 'Bestsellers',
        'condition' => '',
        'order' => 'p.num_choosed desc,priority,rand()',
        'block_head' => "<img src='$SITE_ROOT/img/1x1.gif' width=1 height=4 alt=''><br>"
    );
    include("$ROOT_PATH/modules/products_block.php");
    //-----------------------------------------------/
    ?>

    <?
    //------------------ Lists ---------------------------------\
    $tmp = $CatID ? "categories like '%:$CatID:%'" : 0;
    $res = db_query("select name,products from sc_list
		where active and col=1 and length(products)>2 and
			(all_pages or $tmp)");
    while ($lst = @$sql_fetch_assoc($res))
        if ($prds = array_filter(call('intval', explode(':', $lst['products'])))) {
//-----------------------------------------------\
            $ModuleData = array(
                'header' => $lst['name'],
                'condition' => 'p.prdID in (' . implode(',', $prds) . ')',
                'order' => 'priority,rand()',
                'block_head' => "<img src='$SITE_ROOT/img/1x1.gif' width=1 height=4 alt=''><br>"
            );
            include("$ROOT_PATH/modules/products_block.php");
//-----------------------------------------------/
        }
    //----------------------------------------------------------/
    ?>

</td>
</tr>
</table>

<br>
<table border=0 width=100% cellspacing=0 cellpadding=10 style='background-color:#8E9AD6'>
    <tr>
        <td align=center><b style='color:#FFFFFF;'>Copyright &copy; 2003 <?= $Config['site_name'] ?></b></td>
    </tr>
</table>
