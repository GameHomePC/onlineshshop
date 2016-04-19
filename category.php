<?php
    @include_once('_dir.php');

    if ($args) list($CatID,$page) = $args;

    call('intval',array(&$CatID,&$page));
    $url_name=trim(trim($url_name),'/');
    if ($page<0) $page=0;

    $ActiveCatsOnly=1;
    include_once("$ROOT_PATH/modules/sc_category.php");

    if ($url_name!='') {
        $url_name=to_lower($url_name);

        if (check_int($url_name))
            $CatID=(int)$url_name;
        elseif ($Config['cat_name_to_url'] &&
            ($n=sizeof($tmp=explode('-',$url_name)))>1 &&
            $tmp[$n-1][0]=='c' &&
            check_int($a=@substr($tmp[$n-1],1)) )
            $CatID=(int)$a;
        else
            $CatID=$CategUrlToID[$url_name];
    }

    if ($CatID>1 && ($CategItems[$CatID]['active_info'] || $view_inactive)) {
        if ($CAN_ADMIN_CATS) {
                $query="select c.name as name,title,comment,description,
                meta_title,meta_keywords,meta_description,
                u.uplID as uplID,u.img_not_loaded as img_not_loaded,
                IF(u.img_not_loaded,u.name,CONCAT(u.path,'/',u.name)) as file_name,
                u.width as w, u.height as h
            from sc_category as c
                left join uploads1 as u on c.uplID=u.uplID
            where c.catID=$CatID";
        } else {
            $query="select
            IF(cn.name!='',cn.name,c.name) as name,
            IF(cn.title!='',cn.title,c.title) as title,
            IF(cn.comment!='',cn.comment,c.comment) as comment,
            IF(cn.description!='',cn.description,c.description) as description,
            IF(cn.meta_title!='',cn.meta_title,c.meta_title) as meta_title,
            IF(cn.meta_keywords!='',cn.meta_keywords,c.meta_keywords) as meta_keywords,
            IF(cn.meta_description!='',cn.meta_description,c.meta_description) as meta_description,
            u.uplID as uplID,u.img_not_loaded as img_not_loaded,
            IF(u.img_not_loaded,u.name,CONCAT(u.path,'/',u.name)) as file_name,
            u.width as w, u.height as h
        from sc_category as c
            left join uploads1 as u on c.uplID=u.uplID
            left join sc_category_newval as cn on cn.catID=c.catID
        where c.catID=$CatID";
            $Category=@$sql_fetch_assoc(db_query($query));
        }
    } else {
        $CatID = 0;
    }

    if (!$CatID || !$Category) {
        $RedirectUrl="$SITE_ROOT/";
    } else {
        if ($Category['title']=='') $Category['title']=$Category['name'];
        if ($Category['description']=='') $Category['description']=$Category['comment'];

        $PageTitle=$Category['title'];
        $Meta['title']=$Category['meta_title'] ? $Category['meta_title'] : $Category['title'];
        $Meta['keywords']=$Category['meta_keywords'] ? $Category['meta_keywords'] : $Category['title'];
        $Meta['description']=$Category['meta_description'] ? $Category['meta_description'] :
            ($Category['comment'] ? $Category['comment'] : $Category['title']);
    }

    include_once("$ROOT_PATH/common/all_head.php");
?>

<?php if ($Category['uplID'] || $Category['description']!='' || $Config['cat_show_spec'] || $Config['cat_show_feat']) { ?>
    <div class="category">
        <?php
            if ($Category['uplID']) {
                if (!$Category['img_not_loaded']) $Category['file_name']="$SITE_ROOT/$Category[file_name]";
                echo "<img src='$Category[file_name]' width=$Category[w] height=$Category[h] alt='' align=left>";
            }
        ?>

        <div class="category__description">
            <?php echo $Category['description']; ?>
        </div>

        <?php
            if ($Config['cat_show_feat']) {
                echo '<td width=0 style="padding-left:5px">';

                $ModuleData=array(
                    'page' => 0,
                    'pages_url' => '',
                    'head_title' => 'Featured',
                    'catID' => $CatID,
                    'condition' => "((p.price_type=2 and spec_time1<=$TIME and (!spec_time2 or spec_time2>=$TIME)) or pn.price_type=2)",
                    'cols' => 1,
                    'rows' => 1,
                    'rand' => 1
                );
                include('modules/products_search.php');

                echo '</td>';
            }
        ?>


        <?php
            if ($Config['cat_show_spec']) {
                echo '<td width=0 style="padding-left:5px">';

                $ModuleData=array(
                    'page' => 0,
                    'pages_url' => '',
                    'head_title' => 'Specials',
                    'catID' => $CatID,
                    'condition' => "((p.price_type=1 and spec_time1<=$TIME and (!spec_time2 or spec_time2>=$TIME)) or pn.price_type=1)",
                    'cols' => 1,
                    'rows' => 1,
                    'rand' => 1
                );
                include('modules/products_search.php');

                echo '</td>';
            }
        ?>
    </div>
<?php } ?>


<?php
    if ($CategItems[$CatID]['items']) {
        echo '<u class=hl><b>SUBCATEGORIES:</b></u><br>';
        foreach ($CategItems[$CatID]['items'] as $id) {
            $item=$CategItems[$id];
            if (!$item['active_info']) continue;
            list($name,$tit)=call('to_html',$item['name'],$item['title']);
            $img=($item['has_new'] || $item['last_time']>$T) ? $ImgNew : '';

            echo "<span class=bigCat><span class=bigCatB>",
            ($item['n_prod'] ? "<a href='$SITE_ROOT/$item[href]' title='$tit'><li>$name</a>" : "<li>$name"),
            "</span>&nbsp;($item[n_prod])$img</span>",
            ($item['comment'] ? ' - '.$item['comment'] : ''),
            '<br>';
        }
        echo '<hr width=100% noshade size=1 color=#E5E3E3 align=left>';
    }
?>


<?php
    $pages_url="$SITE_ROOT/".
        str_replace('<Cat>',$CategItems[$CatID]['url_name'].'_page<page>',$CAT_LINK_TEMPLATE[$Config['cat_link_style']]);

    $ModuleData=array(
        'page' => $page,
        'pages_url' => $pages_url,
        'head_title' => $Category['name'],
        'catID' => $CatID,
        'show_desc' => 1
    );

    include('modules/products_search.php');
?>

<?php
    include_once("$ROOT_PATH/common/all_tail.php");
?>

<?php
    if ($Hour>=0 && $Hour<=6 && $Config['auto_update_period'] &&
        ((int)$Config['last_time_updated']+$Config['auto_update_period']*3600)<$TIME) {
?>

    <script>
    <!--
        img=new Image;
        img.src="<?= $SITE_ROOT ?>/get_bases.php";
    //-->
    </script>
<? } ?>