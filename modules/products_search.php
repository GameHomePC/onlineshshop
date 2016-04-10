<?php
void();
//--------------------\
// INPUT:
// $ModuleData[
//	"page"
//	"pages_url"	 (<page> - template)
//	"head_title"
//	"catID"
//	"mnfID"
//	"condition"
//	"order"
//	"search_text"
//	"any_word"
//	"cols"
//	"rows"
//	"rand"
//	"show_desc"
//	]
//--------------------------------------/
?>

    <?php
    $need_pagebar = ($ModuleData['pages_url'] != '');

    $show_desc_num = $ModuleData['show_desc'] ? $Config['descr_preview_num'] : 0;

    $tmp = ($ModuleData['catID'] || $view_inactive) ?
        '' : "cp.catID in ($CategItemsActKeys) and";
    $condition = "p.active and $tmp
        time_available<=$TIME and cp.prdID=p.prdID" .
        ($ModuleData['condition'] ? " and $ModuleData[condition]" : '');

    if ($ModuleData['catID'])
        if ($CategItems[$ModuleData['catID']]['items']) {
            $tmp = array();
            $s_cat_tmp = '_' . str_pad($ModuleData['catID'], 6, '0', STR_PAD_LEFT) . '_';
            foreach ($CategItems as $id => $item)
                if (strpos($item['tree_info'], $s_cat_tmp) !== false) $tmp[] = $id;
            if ($tmp) $condition .= ' and cp.catID in (' . implode(',', $tmp) . ')';
        } else $condition .= " and cp.catID=$ModuleData[catID]";

    if ($ModuleData['mnfID']) $condition .= " and p.mnfID=$ModuleData[mnfID]";

    if ($text = trim($ModuleData['search_text'])) {
        $condition .= ($tmp = make_search_condition($text, "IF(pn.name!='',pn.name,p.name)", ($ModuleData['any_word'] ? 0 : 2))) ? " and $tmp" : ' and 0';

        if ($need_pagebar)
            $ModuleData['pages_url'] .= ((strpos($ModuleData['pages_url'], '?') === false) ? '?' : '&') . 'search_text=' . to_url($text);
    }

    if ($need_pagebar) {
        $num_rows = @$sql_result(db_query("select count(DISTINCT p.prdID)
                from (sc_product as p, sc_category_prod as cp)
                    left join sc_product_newval as pn on p.prdID=pn.prdID
                where $condition"), 0, 0);
        if (!$num_rows) return;
    }

    $Cols = $ModuleData['cols'];
    $Rows = $ModuleData['rows'];
    if (!$Cols) $Cols = $Config['img_cat_cols'] ? $Config['img_cat_cols'] : 3;
    if (!$Rows) $Rows = $Config['img_cat_rows'] ? $Config['img_cat_rows'] : 3;
    $portion = $Cols * $Rows;

    if ($need_pagebar) {
        $pages = ceil($num_rows / $portion);
        if ($ModuleData['page'] < 0) $ModuleData['page'] = 0;
        if ($ModuleData['page'] > ($pages - 1)) $ModuleData['page'] = $pages - 1;
        $start = $ModuleData['page'] * $portion;
    } else {
        $start = 0;
    }

    $group = ($ModuleData['catID'] && !$CategItems[$ModuleData['catID']]['items']) ?
        '' : 'group by p.prdID';
    $tmp = $show_desc_num ?
        "IF(pn.description!='',pn.description,p.description) as description," : '';

    $res = db_query("select p.prdID as prdID,in_stock,quantity,url_name,
            price,p.price_type as price_type,spec_price,spec_time1,spec_time2,
            pn.price_type as price_type_new,
            cp.catID as catID,p.priority as priority,
            attributes,

            IF(pn.name!='',pn.name,p.name) as name,
    #		IF(pn.comment!='',pn.comment,p.comment) as comment,
            $tmp

            IF(u1.uplID,u1.uplID,0) as uplID1,
            IF(u2.uplID,u2.uplID,0) as uplID2,
    #		IF(u3.uplID,u3.uplID,0) as uplID3,
            IF(u1.img_not_loaded,u1.name,CONCAT(u1.path,'/',u1.name)) as fname1,
            IF(u2.img_not_loaded,u2.name,CONCAT(u2.path,'/',u2.name)) as fname2,
    #		IF(u3.img_not_loaded,u3.name,CONCAT(u3.path,'/',u3.name)) as fname3,
            u1.width as width1,u1.height as height1,
            u2.width as width2,u2.height as height2,
    #		u3.width as width3,u3.height as height3,
            u1.img_not_loaded as img_not_loaded1,
            u2.img_not_loaded as img_not_loaded2
    #		u3.img_not_loaded as img_not_loaded3
        from (sc_product as p,sc_category_prod as cp)
          left join sc_product_newval as pn on pn.prdID=p.prdID
          left join uploads1 as u1 on uplID1=u1.uplID
          left join uploads1 as u2 on uplID2=u2.uplID
    #	  left join uploads1 as u3 on uplID3=u3.uplID
        where $condition
        $group
        order by " . ($ModuleData['order'] ? "$ModuleData[order]," : '') .
        "p.price_type_new DESC,priority,is_new DESC" .
        ($ModuleData['rand'] ? ',rand()' : ',name') .
        " limit $start,$portion");

    if (!$need_pagebar) {
        $num_rows = @$sql_num_rows($res);
        if (!$num_rows) return;
    }

    if ($need_pagebar) {
        $prv_p = ($ModuleData['page'] ?
            "<div class='pagination__pn pagination__prev'><a class='pagination__button' href='" . str_replace('<page>', ($ModuleData['page'] - 1), $ModuleData['pages_url']) . "'>Previous Page</a></div>" : "");
        $nxt_p = ($ModuleData['page'] < ($pages - 1) ?
            "<div class='pagination__pn pagination__next'><a class='pagination__button' href='" . str_replace('<page>', ($ModuleData['page'] + 1), $ModuleData['pages_url']) . "'>Next Page</a></div>" : "");
    }

    $tmp = $need_pagebar ? ": $num_rows items" : '';
    $pagebar_top = "
        <table border=0 width=100% cellspacing=0 cellpadding=0 background='$SITE_ROOT/img/left_vmenu.gif' class=pagebar>
            <tr valign=middle>
                <td width=0><img src='$SITE_ROOT/img/left_vmenu1.gif' alt='' width=18 height=22></td>
                <td width=0 nowrap class=pagebar><nobr>$ModuleData[head_title]$tmp</nobr></td>" .
                    ((!$need_pagebar) ? '<td width=100%></td>' :
                "<td align=right nowrap class=pagebar width=100%>
                    <form name=pagebar action='javascript:void(0)' style='margin:0'>&nbsp;
                        &nbsp; $prv_p &nbsp; <b>Page " .
                            (($pages > 1) ? get_elem(create_select('page', range(1, $pages), $ModuleData['page'])) : 1) .
                            " / $pages</b> &nbsp; $nxt_p &nbsp; &nbsp;</form></td>") .
            '</tr>
        </table>';

    if ($need_pagebar) {
        $max_pages = 15;
        $p = $ModuleData['page'] + 1;
        $p1 = 0;
        $p2 = $pages + 1;
        if ($pages > $max_pages) {
            $p1 = $p - intval(($max_pages - 1) / 2);
            if ($p1 < 1) $p1 = 1;
            $p2 = $p1 + $max_pages - 1;
            if ($p2 > $pages) {
                $p2 = $pages;
                $p1 = $p2 - $max_pages + 1;
            }
            $p1++;
            $p2--;
            if ($p1 < 3) $p1 = 0;
            if ($p2 > ($pages - 2)) $p2 = $pages + 1;
        }

        $tmp = array();
        for ($i = 1; $i <= $pages; $i++) {
            if ($i != 1 && $i != $pages)
                if ($i < $p1) {
                    $i = $p1 - 1;
                    continue;
                } elseif ($i > $p2) {
                    $i = $pages - 1;
                    continue;
                }
            if ($i == $p1 || $i == $p2) {
                $tmp[] = '<div class="pagination__dot">...<div>';
                continue;
            }
            $tmp[] = ($i == $p) ?
                "<div class='pagination__page'>$p</div>" :
                "<a class='pagination__page' href='" . str_replace('<page>', ($i - 1), $ModuleData['pages_url']) . "'><u>$i</u></a>";
        }
        $tmp = implode('&nbsp; ', $tmp);

        $pagebar_bottom = "
        <div class='pagination'>
            $prv_p
            <div class='pagination__box'>$tmp</div>
            $nxt_p
        </div>";

        $pagebar_top = str_replace(array('_0.', '_page0'), array('.', ''), $pagebar_top);
        $pagebar_bottom = str_replace(array('_0.', '_page0'), array('.', ''), $pagebar_bottom);
    }

    ?>
<div class="container container--sidebar container--right">

    <?php /*echo $pagebar_top;*/ ?>

    <div class="productSlider" id="productSlider">
        <div class="productSlider__item">
            <div class="productSlider__images">
                <img src="<?php echo $SITE_ROOT ?>/img/images-1-slider.png" alt="">
            </div>

            <div class="productSlider__content">
                <div class="productSlider__title">
                    10 Panel Dip Drug Testing Kit, Test for 10 Different Drugs.
                </div>

                <div class="productSlider__button">
                    <div class="productSlider__buttonBox">
                        <span class="productSlider__price">from $25.49</span>
                        <span class="productSlider__buy">shop now</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="productSlider__item">
            <div class="productSlider__images">
                <img src="<?php echo $SITE_ROOT ?>/img/images-1-slider.png" alt="">
            </div>

            <div class="productSlider__content">
                <div class="productSlider__title">
                    10 Panel Dip Drug Testing Kit, Test for 10 Different Drugs.
                </div>

                <div class="productSlider__button">
                    <div class="productSlider__buttonBox">
                        <span class="productSlider__price">from $25.49</span>
                        <span class="productSlider__buy">shop now</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="productSlider__item">
            <div class="productSlider__images">
                <img src="<?php echo $SITE_ROOT ?>/img/images-1-slider.png" alt="">
            </div>

            <div class="productSlider__content">
                <div class="productSlider__title">
                    10 Panel Dip Drug Testing Kit, Test for 10 Different Drugs.
                </div>

                <div class="productSlider__button">
                    <div class="productSlider__buttonBox">
                        <span class="productSlider__price">from $25.49</span>
                        <span class="productSlider__buy">shop now</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid">

        <?php
        $WidthPer = (int)(100 / $Cols);
        $N = $start;
        while ($Arr = @$sql_fetch_assoc($res)) {
            $N++;
            extract($Arr);
            $fname1 = $Arr['fname1'];
            $fname2 = $Arr['fname2'];
            $width1 = $Arr['width1'];
            $width2 = $Arr['width2'];
            $height1 = $Arr['height1'];
            $height2 = $Arr['height2'];
            $img_not_loaded1 = $Arr['img_not_loaded1'];
            $img_not_loaded2 = $Arr['img_not_loaded2'];

            $href = "$SITE_ROOT/" . make_prd_url($Arr['catID'], $Arr['prdID'], $Arr['url_name'], $Arr['name']);

            list($spec, $price_str, $old_price_str) =
                make_prd_price($price, $price_type, $spec_price, $spec_time1, $spec_time2, $price_type_new);

            if($old_price_str) {
                $price_str = '<span class="old">$' . $old_price_str . '</span>' . '<span class="new">$' . $price_str . '</span>';
            } else {
                $price_str = '$' . $price_str;
            }

            $description = $show_desc_num ?
                '<div class=desc_preview>' . content_cut($description, $show_desc_num) . '</div>' : '';

            $W = 300;
            $H = 300;
            $width = $height = 0;

            $image = '';
            if ($uplID2 && ($Config['img_cat_mid'] || !$uplID1)) {
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
            if (($uplID1 || $uplID2) && (!$width || !$height)) {
                $width = 110;
                $height = 110;
            }

            if ($image) $image = "<img src='$image' alt='$name'>";

            $href1 = $attributes ? $href : make_buy_url($prdID, $ModuleData['catID']);
            ?>

            <?php if (($N % $Cols) == 1 || $Cols == 1) echo '<tr valign=top align=center>'; ?>
                <div class="grid__item">
                    <a href='<?php echo $href; ?>'>
                        <?php echo $image; ?>
                        <div class="grid__title"><?php echo $name; ?></div>
                        <div class="grid__price">
                            <?php echo $price_str; ?>
                        </div>

                        <div class="grid__button">
                            <?php if ($in_stock && $quantity) { ?>
                                <a class="grid__linkB" href="<?php echo $href1; ?>" rel='nofollow'>Buy now</a>
                            <?php } else { ?>
                                <b class="grid__linkB">OUT</b>
                            <?php } ?>
                        </div>

                        <?php echo $description; ?>
                    </a>
                </div>

            <?php
                if (!($tmp = $N % $Cols) || $N == $num_rows) {
                    if ($tmp) echo str_repeat("<div class='grid__item'></div>", $Cols - $tmp);
                }
            ?>

        <?php } ?>
    </div>

    <?php echo $need_pagebar ? $pagebar_bottom : ''; ?>

    <?php if ($need_pagebar && $pages > 1) { ?>
        <script>
            <!--
            pages_url = '<?= to_js($ModuleData['pages_url']) ?>';

            function changePage() {
                var a = pages_url.replace('<page>', this.selectedIndex);
                a = a.replace('_0.', '.');
                a = a.replace('_page0', '');
                document.location.href = a;
            }

            if (document.forms.pagebar) {
                f = document.forms.pagebar;
                if (f.pagebar)
                    for (i = 0; i < f.length; i++)
                        el = f[i].page.onchange = changePage;
                else
                    f.page.onchange = changePage;
            }
            //-->
        </script>
    <?php } ?>
</div>

<div class="sidebar sidebar--small">
    <div class="box">
        <div class="box__item">
            <div class="boxList">
                <h3 class="boxList__title">All Category</h3>
                <ul class="boxList__list">
                    <?php
                    if (!$Config['left_menu_style']) {

                        include("$ROOT_PATH/modules/menu_categories.php");

                    } else {

                        echo '<div class="tree_usual">';

                        $TreeInfo = $CategItems[$CatID]['tree_info'];

                        foreach ($CategItems as $id => $item) {

                            if ($id < 2) continue;
                            $lev = $item['level'];

                            if ($lev != 1 && !strpos($TreeInfo, '_' . str_pad($item['parID'], 6, '0', STR_PAD_LEFT) . '_'))
                                continue;
                            list($name_, $comm_) = call('to_html', $item['name'], $item['comment']);
                            if ($Config['menu_prd_count']) $name_ .= "<nobr>&nbsp;($item[n_prod])</nobr>";


                            $tmp = ($CatID == $id) ? 'class="active"' : '';
                            $name_ = "<a href='$SITE_ROOT/$item[href]' title='$comm_' $tmp>$name_</a>";

                            echo "<div style='padding-left:", (($lev - 1) * 10), "'>$name_</div>";

                        }
                        echo '</div>';
                    }
                    ?>

                    <li><a href='<?php echo $SITE_ROOT ?>/prod_special.html'>Specials</a></li>
                    <li><a href='<?php echo $SITE_ROOT ?>/prod_new.html'>New Products</a></li>
                    <li><a href='<?php echo $SITE_ROOT ?>/prod_featured.html'>Featured Products</a></li>
                    <li><a href='<?php echo $SITE_ROOT ?>/prod_bestseller.html'>Bestsellers</a></li>
                    <li><a href='<?php echo $SITE_ROOT ?>/search_prod.html' rel='nofollow'>extended search</a></li>
                </ul>
            </div>
        </div>

        <div class="box__item">
            <div class="boxBanner">
                <a href="/">
                    <img src="<?php echo $SITE_ROOT ?>/img/bunner/image-1.jpg" alt="">
                </a>
            </div>
        </div>

        <div class="box__item">
            <div class="boxUps">
                <div class="boxUps__images">
                    <img src="<?php echo $SITE_ROOT ?>/img/ups.png" alt="">
                </div>

                <div class="boxUps__content">
                    <span>Free UPS Group Shipping</span>
                    <a href="/">Read more</a>
                </div>
            </div>
        </div>
    </div>
</div>
