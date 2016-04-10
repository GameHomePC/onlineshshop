<?
// ====================================\
@include_once('_dir.php');
// ====================================/

include_once("$ROOT_PATH/common/all_head.php");
?>


<?
//------------------------------------------\
$search_text=trim($search_text);
$search_text_html=to_html($search_text);
//------------------------------------------/
?>

    <form action='<?= $SITE_ROOT ?>/search.html' style='margin:0'
          onSubmit="return formSubmitOnce(this,checkFilled(this.search_text,'Enter text for the search'))">
        <span class=head>Search Word:</span>
        <input type=text name='search_text' size=10 maxlength=100 value="<?= $search_text_html ?>">
        <input class=buttonH type=submit value="Search >>">&nbsp;
    </form>

<?
/*
  if (($tmp=to_url($search_text))!='')
    echo "<br><div class=warn>- You may also try to seach for
	'<span class=note>$search_text_html</span>' in
	<a href='$SITE_ROOT/forum/search_keywords__$tmp/search_terms__all/search.htm'>Forum</a>.</div>";
*/
?>

    <hr class=border size=1 noshade>


<?
if ($search_text!='') {
//=====================================================================================\
//    $sql=trim(preg_replace('/[<>%\s]+/',' ',$search_text));
    $text=trim(preg_replace('/[<>%\s]+/',' ',$search_text));
    ?>

    <div class=header>Search result for '<span class=note><?= $search_text_html ?></span>':</div>

<?
//  if ($sql!='') {
    if ($text!='') {
// ============================================================================\

//-------------------- Regular Pages ---------------------\
        /*
          $sql=str_replace(' ','% ',to_sql_search($sql));
          $res=db_query("select pageID,type,static_page,title,
                    if(url_name!='',url_name,pageID) as url_name
                from site_pages
                where (title like '$sql%' or title like '% $sql%'
                    or content1 like '$sql%' or content1 like '% $sql%'
                    or content1 like '%>$sql%'or content1 like '%\n$sql%'
                    or content2 like '$sql%' or content2 like '% $sql%'
                    or content2 like '%>$sql%' or content2 like '%\n$sql%')
                    and (type<2 or active)
                order by type,priority");
        */

        $cond=($tmp=make_search_condition($text,array('title','content1','content2'))) ?
            " and $tmp" : ' and 0';
        $res=db_query("select pageID,type,static_page,title,
			if(url_name!='',url_name,pageID) as url_name
		from site_pages
		where (type<2 or active) $cond
		order by type,priority");

        $t=-1;
        while ($row=@$sql_fetch_assoc($res)) {
            @extract($row);
            $uri=make_url($static_page,$url_name,$type);
            $title=to_html($title);
            if ($t<0 && $type<2) echo "<br><div class=txtB>&#149; Found regular pages:</div>";
            elseif ($t<2 && $type==2) echo "<br><div class=txtB>&#149; Found articles:</div>";
            echo "<a href='$uri'>$title</a><br>";
            $t=$type;
        }


//-------------------- News ---------------------\
        /*
          $res=db_query("select nwsID,archive,title from news
                where (title like '$sql%' or title like '% $sql%'
                    or content like '$sql%' or content like '% $sql%'
                    or content like '%>$sql%' or content like '%\n$sql%')
                order by archive,time DESC");
        */

        $cond=($tmp=make_search_condition($text,array('title','content'))) ?
            $tmp : 0;
        $res=db_query("select nwsID,archive,title
		from news where $cond
		order by archive,time DESC");

        $t=0;
        while ($row=@$sql_fetch_assoc($res)) {
            @extract($row);
            $uri="news".($archive ? '_1' : '').".html#$nwsID";
            $title=to_html($title);
            if (!$t) echo "<br><div class=txtB>&#149; Found news:</div>";
            echo "<a href='$SITE_ROOT/$uri'>$title</a><br>";
            $t=1;
        }


//-------------------- Product Categories ---------------------\
        if ($CAN_ADMIN_CATS) {
            $cond=($tmp=make_search_condition($text,array('title','comment','description'))) ?
                $tmp : 0;
            $query="select c.catID as catID,title,comment,description
	from sc_category as c
		inner join sc_category_stat as cs on c.catID=cs.catID and cs.n_prod>0
	where c.catID in ($CategItemsActKeys) and $cond
	order by parID,priority,c.catID";
        }
        else {
            $cond=($tmp=make_search_condition($text,
                array(
                    "IF(cn.title!='',cn.title,c.title)",
                    "IF(cn.comment!='',cn.comment,c.comment)",
                    "IF(cn.description!='',cn.description,c.description)"
                ))) ?
                $tmp : 0;
            $query="select c.catID as catID,
		IF(cn.title!='',cn.title,c.title) as title,
		IF(cn.comment!='',cn.comment,c.comment) as comment,
		IF(cn.description!='',cn.description,c.description) as description
	from (sc_category as c
		inner join sc_category_stat as cs on c.catID=cs.catID and cs.n_prod>0)
		left join sc_category_newval as cn on c.catID=cn.catID
	where c.catID in ($CategItemsActKeys) and $cond
	order by parID,c.priority,c.catID";
        }
        $res=db_query($query);

        $t=0;
        while ($row=@$sql_fetch_assoc($res)) {
            if (!$t) echo "<br><div class=txtB>&#149; Found categories:</div>";
            echo getCategPathStr($row['catID'],1),"<br>";
            $t=1;
        }


//-------------------- Products ---------------------\
        echo '<hr width=100% noshade size=1 color=#E5E3E3 align=left>';

//-------------------------------------\
        $ModuleData=array(
            'page' => (int)$args[0],
            'pages_url' => 'search_<page>.html',
            'head_title' => 'Found Products',
            'search_text' => $text,
            'show_desc' => 1
        );

        include('modules/products_search.php');
//-------------------------------------/



// ============================================================================/
    }
//=====================================================================================/
}
?>


<?
include_once("$ROOT_PATH/common/all_tail.php");
?>