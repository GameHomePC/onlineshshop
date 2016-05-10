<? void();
// ------------------------------------------------\
//  $EditMenu=0;
//  $MenuName='site_menu';
//  include("$ROOT_PATH/modules/menu_struct.php");
//  include("$ROOT_PATH/modules/menu_print.php");
// ------------------------------------------------/
?>

<?php /* ?>

    <table width=100% border=0 cellpadding=0 cellspacing=0 class=pageHeader>

        <tr class=menuLine>
            <td background="<?= $SITE_ROOT ?>/img/menu_pas.gif" height=31>



                <table cellpadding=0 cellspacing=0 border=0 width=100%>
                    <tr>
                        <td nowrap style='padding:0 25 0 7'>
                            <?
                            if ($NO_EXTERNAL) {
                                ?>
                                <a class=menu href="<?= $SC_SITE_URL ?>/sc/sc.php?shop=<?= $SHOP_ID ?>" rel='nofollow'>My&nbsp;Cart</a>
                                <a class=menu href="<?= $SC_SITE_URL ?>/sc/login.php?shop=<?= $SHOP_ID ?>"
                                   rel='nofollow'>Checkout</a>
<?
                            } else {
                                ?>

                                <? if ($SC_QUANTITY) { ?>
                                    <a class=menu href="<?= $SITE_ROOT ?>/sc.html" rel='nofollow'>My&nbsp;Cart</a>
                                    <a class=menu
                                       href="<?= $SECURE_URL_HEADER ?>/<?= $CUSTOMER_ID ? 'addresses.html' : 'choice.html' ?>"
                                       rel='nofollow'>Checkout</a>
                                <? } ?>
                            }
                            ?>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

<?php */ ?>


<header class="header">
    <div class="wrapper">
        <div class="headerBox">
            <div class="headerBox__item headerBox__status">
                <div class="statusH">
                    <a href="<?php echo $SITE_ROOT . '/'; ?>" title="<?php echo to_html($Config['site_name']); ?>">
                        <span class="statusH__content">
                            <span class="statusH__blue statusH__blue_big">2</span>
                            <span class="statusH__green statusH__green_big">4</span>
                            <span class="statusH__blue">drag</span>
                            <span class="statusH__green">test</span>
                        </span>
                    </a>
                </div>
            </div>

            <div class="headerBox__item headerBox__select">
                <div class="selectH">
                    <div class="selectH__minText">Select</div>
                    <div class="selectH__item">
                        <span class="selectH__title">Category</span>

                        <div class="selectHSub">
                            <div class="selectHSub__box">
                                <ul class="selectHSub__catalog">
                                    <li><a class=menu href="<?= $SITE_ROOT ?>/">Home</a></li>
                                    <li><a class=menu href="<?= $SITE_ROOT ?>/news.html">News</a></li>
                                    <li><a class=menu href="<?= $SITE_ROOT ?>/contact_us.html">Contact Us</a></li>
                                    <li><a class=menu href="<?= $SITE_ROOT ?>/search.html" rel='nofollow'>Site Search</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="headerBox__item headerBox__search">
                <form
                    class="searchH"
                    action="<?= $SITE_ROOT ?>/search_prod.html"
                    onSubmit="return formSubmitOnce(this, checkFilled(this.search_text,'Enter text for the search'))">
                    <div class="searchH__box">
                        <input class="searchH__input"
                               type="search"
                               placeholder="Search"
                               name="search_text"
                               maxlength="100"
                               value="<?= to_html($search_text) ?>"
                            />
                        <button class="searchH__button"></button>
                    </div>
                </form>
            </div>

            <div class="headerBox__item headerBox__list">
                <ul class="listH">
                    <li class="listH__item"><a href="#">News</a></li>
                    <li class="listH__item"><a href="#">About Us</a></li>
                    <li class="listH__item"><a href="#">Contact Us</a></li>
                </ul>
            </div>

            <div class="headerBox__item headerBox__account">
                <div class="headerBox__box verticatfix">
                    <div class="headerLogin">
                        <ul class="headerLogin__box headerLogin_join">
                            <li><a href="#" onclick="scrollToBox('.footer'); return false;">Join our mailing list</a></li>
                        </ul>

                        <ul class="headerLogin__box">
                            <?php if(!$CUSTOMER_ID): ?>
                                <li><a href="<?php echo $SITE_ROOT; ?>/login_form.html">Login</a></li>
                                <li><a href="<?php echo $SITE_ROOT; ?>/register_form.html">Registration</a></li>
                            <?php endif; ?>

                            <?php if($CUSTOMER_ID): ?>
                                <li><a href="<?= $SECURE_URL_HEADER ?>/account.html">Your account</a></li>
                                <li><a href="<?php echo $SITE_ROOT; ?>/logout.html?toploginform_url=<?php echo to_url($REQUEST_URI); ?>">Logout</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <div class="headerBox__box headerBox__bag">
                    <?php if ($NO_EXTERNAL) { ?>

                        <a href="<?php echo $SC_SITE_URL ?>/sc/sc.php?shop=<?= $SHOP_ID ?>" class="bagH">
                        <span class="bagH__number">
                            <script src="<?= $SC_SITE_URL ?>/EXPORT/quantity.php?shop=<?= $SHOP_ID ?>"></script>
                        </span>
                            <span class="bagH__icon"></span>
                        </a>

                    <?php } elseif ($SC_QUANTITY) { ?>

                        <a href="<?php echo $SITE_ROOT ?>/sc.html" class="bagH">
                            <span class="bagH__number"><?php echo $SC_QUANTITY ?></span>
                            <span class="bagH__icon"></span>
                        </a>

                    <?php } else { ?>

                        <div class="bagH">
                            <span class="bagH__number">0</span>
                            <span class="bagH__icon"></span>
                        </div>

                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="breadCrumbs">
            <?php
            if ($Config['show_nav_line'] && !$IsHomePage):
                if ($CatID)
                    if ($PrdID)
                        $NavLine = getCategPathStr($CatID, 1, 'navline', ' / ', 1, 0) .
                            ($Config['show_nav_line_last'] ? to_html($Product['name']) : '');
                    else
                        $NavLine = getCategPathStr($CatID, 0, 'navline', ' / ', $Config['show_nav_line_last'], 0);
                else
                    $NavLine = (($PageData['type'] == 2) ? "<a href='$SITE_ROOT/articles.html'>Articles</a> /" : '') .
                        (($Config['show_nav_line_last'] || $IsHomePage) ? " $NavLineTitle" : '')
                ?>

                <ul class="breadCrumbs__list">
                    <?php if (!$IsHomePage) { ?>
                        <li><a href='<?= $SITE_ROOT ?>/'>Online Healthcare</a></li>
                    <?php } ?>

                    <li><?php echo $NavLine ?></li>
                </ul>

            <?php endif; ?>
        </div>
    </div>
</header>

<div class="content">
    <div class="wrapper">

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
                    </ul>
                </div>
            </div>

            <div class="box__item">
                <div class="boxList">
                    <h3 class="boxList__title">Bestsellers</h3>
                    <ul class="boxList__list_best">
                        <?php
                        $ModuleData = array(
                            'header' => 'Bestsellers',
                            'condition' => '',
                            'order' => 'p.num_choosed desc,priority,rand()',
                            'block_head' => "<img src='$SITE_ROOT/img/1x1.gif' width=1 height=4 alt=''><br>"
                        );
                        include("$ROOT_PATH/modules/products_block.php");
                        ?>

                        <?php
                        $tmpOne = $CatID ? "categories like '%:$CatID:%'" : 0;
                        $resOne = db_query("select name,products from sc_list where active and col=1 and length(products)>2 and (all_pages or $tmpOne)");

                        while ($lst = @$sql_fetch_assoc($resOne)) {
                            if ($prds = array_filter(call('intval', explode(':', $lst['products'])))) {
                                $ModuleData = array(
                                    'header' => $lst['name'],
                                    'condition' => 'p.prdID in (' . implode(',', $prds) . ')',
                                    'order' => 'priority,rand()',
                                    'block_head' => "<img src='$SITE_ROOT/img/1x1.gif' width=1 height=4 alt=''><br>"
                                );
                                include("$ROOT_PATH/modules/products_block.php");
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

        <div class="container container--sidebar container--left">

        <?php /* ?>
                <td width=0 style='padding-left:1px'>
                    <img src='<?= $SITE_ROOT ?>/img/1x1.gif' width="160" height="1" alt=''><br>

                    <?php
                        if ($IsHomePage && $Config['num_news_feat'] && @$sql_num_rows($res = db_query("select nwsID,time,title,content from news where archive=0 order by time DESC limit $Config[num_news_feat]"))) {
                    ?>
                        <img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=4 alt=''><br>
                        <table border=0 width=100% cellspacing=0 cellpadding=0 background="<?= $SITE_ROOT ?>/img/left_vmenu.gif"
                               class='infoBoxHead'>
                            <tr>
                                <td width=18><img src="<?= $SITE_ROOT ?>/img/left_vmenu1.gif" alt="" width=18 height=22></td>
                                <td width=100% nowrap class=infoBoxHead>Last News</td>
                            </tr>
                        </table>
                        <table border=0 width=100% cellspacing=0 cellpadding=1 class=border>
                            <tr>
                                <td>
                                    <table border=0 width=100% cellspacing=0 cellpadding=3 class=bg>
                                        <tr>
                                            <td align=left style='padding:7px;padding-bottom:3px;'>
                                                <?
                                                while ($row = @$sql_fetch_assoc($res)) {
                                                    $row['time'] = get_date_str($row['time']);
                                                    $title = to_html($title);

                                                    echo "<div style='padding-bottom:5px'><a href='news_view_$row[nwsID].html'>$row[title]</a></div>";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    <?php } ?>

                    <?php
                        if (@$sql_result(db_query("select count(*) from sc_manufacturer"), 0, 0)) {
                    ?>

                        <script>
                        <!--
                            function check_search_mnf(f) {
                                var el = f.url_name;
                                D.location.href = '<?= $SITE_ROOT ?>/manufacturer_' + el.options[el.selectedIndex].value + '.html';
                                return false;
                            }
                        //-->
                        </script>

                        <img src='<?= $SITE_ROOT ?>/img/1x1.gif' width=1 height=4 alt=''><br>

                        <table border=0 width=100% cellspacing=0 cellpadding=0 background="<?= $SITE_ROOT ?>/img/left_vmenu.gif"
                               class='infoBoxHead'>
                            <tr>
                                <td width=18><img src="<?= $SITE_ROOT ?>/img/left_vmenu1.gif" alt="" width=18 height=22></td>
                                <td width=100% nowrap class=infoBoxHead>Manufaturers</td>
                            </tr>
                        </table>
                        <table border=0 width=100% cellspacing=0 cellpadding=1 class=border>
                            <tr>
                                <td>
                                    <table border=0 width=100% cellspacing=0 cellpadding=3 class=bg>
                                        <form name='search_mnf' action='<?= $SITE_ROOT ?>manufacturer.html' rel='nofollow'
                                              onSubmit="return formSubmitOnce(this,check_search_mnf(this))">
                                            <tr>
                                                <td align=center style='padding-top:10px;padding-bottom:10px;' nowrap>
                                                    <?php echo
                                                        get_elem(create_select('url_name', "select
                                                            IF(mn.url_name!='',mn.url_name,m.mnfID),
                                                            IF(mn.name!='',mn.name,m.name)
                                                        from sc_manufacturer as m
                                                             left join sc_manufacturer_newval as mn on mn.mnfID=m.mnfID
                                                        order by 2", $MnfID))
                                                    ?>
                                                    <input type=submit class=buttonH value=">">
                                                </td>
                                            </tr>
                                        </form>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <script>
                        <!--
                            document.forms.search_mnf.url_name.style.width = 140;
                        //-->
                        </script>

                    <?php } ?>

                    <?php
                        $ModuleData = array(
                            'header' => 'New Products',
                            'condition' => 'p.is_new',
                            'order' => 'priority,rand()',
                            'block_head' => "<img src='$SITE_ROOT/img/1x1.gif' width=1 height=4 alt=''><br>"
                        );
                        include("$ROOT_PATH/modules/products_block.php");
                    ?>

                    <?php
                        $tmp = $CatID ? "categories like '%:$CatID:%'" : 0;
                        $res = db_query("select name,products from sc_list where active and col=0 and length(products)>2 and (all_pages or $tmp)");

                        while ($lst = @$sql_fetch_assoc($res)) {
                            if ($prds = array_filter(call('intval', explode(':', $lst['products'])))) {

                                $ModuleData = array(
                                    'header' => $lst['name'],
                                    'condition' => 'p.prdID in (' . implode(',', $prds) . ')',
                                    'order' => 'priority,rand()',
                                    'block_head' => "<img src='$SITE_ROOT/img/1x1.gif' width=1 height=4 alt=''><br>"
                                );
                                include("$ROOT_PATH/modules/products_block.php");
                            }
                        }
                    ?>
                </td>
                <?php */ ?>

        <?php /*
            if ($PageTitle) {
                if ($PageData['type'] == 2) $PageTitle = "<a href='$SITE_ROOT/articles.html'>Articles</a> &gt; $PageTitle";
                echo "<h1>$PageTitle</h1>";
            }
        */ ?>