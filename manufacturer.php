<?
// ====================================\
@include_once('_dir.php');
// ====================================/

// ------------------------------------\
if ($args) list($MnfID, $page) = $args;
call('intval', array(&$MnfID, &$page));
$url_name = trim(trim($url_name), '/');
if ($page < 0) $page = 0;
// ------------------------------------/

if (check_int($url_name)) {
    $MnfID = (int)$url_name;
    $url_name = '';
}

$cond = 0;
if ($url_name != '')
    $cond = "mn.url_name='" . to_sql($url_name) . "'";
elseif ($MnfID) {
    $cond = "m.mnfID=$MnfID";
    $url_name = $MnfID;
}

if ($cond) {
// ----------------------------------------------------------------------------\
    $Manufacurer = @$sql_fetch_assoc(db_query("select m.mnfID as mnfID,url,
			IF(mn.name!='',mn.name,m.name) as name,
			IF(mn.content!='',mn.content,m.content) as description,
			IF(mn.meta_title!='',mn.meta_title,m.meta_title) as meta_title,
			IF(mn.meta_keywords!='',mn.meta_keywords,m.meta_keywords) as meta_keywords,
			IF(mn.meta_description!='',mn.meta_description,m.meta_description) as meta_description,
			m.uplID as uplID,u.img_not_loaded as img_not_loaded,
			IF(u.img_not_loaded,u.name,CONCAT(u.path,'/',u.name)) as file_name,
			u.width as w, u.height as h
		from sc_manufacturer as m
			left join uploads1 as u on m.uplID=u.uplID
			left join sc_manufacturer_newval as mn on mn.mnfID=m.mnfID
		where $cond"));
    $MnfID = $Manufacurer['mnfID'];
// ----------------------------------------------------------------------------/
}

if (!$cond || !$MnfID) $RedirectUrl = "$SITE_ROOT/";
else {
    $pages_url = "$SITE_ROOT/manufacturer_{$url_name}_page<page>.html";

    $PageTitle = $Manufacurer['name'];
    $Meta['title'] = $Manufacurer['meta_title'] ? $Manufacurer['meta_title'] : $Manufacurer['name'];
    $Meta['keywords'] = $Manufacurer['meta_keywords'] ? $Manufacurer['meta_keywords'] : $Manufacurer['name'];
    $Meta['description'] = $Manufacurer['meta_description'] ? $Manufacurer['meta_description'] : $Manufacurer['name'];
}

include_once("$ROOT_PATH/common/all_head.php");
?>


<?
if ($Manufacurer['uplID'] || $Manufacurer['description'] != '' ||
    $Config['cat_show_spec'] || $Config['cat_show_feat']
) {
    $nm = to_html($Manufacurer['name']);
//---------------------------------------------------------\
    ?>
    <table border=0 cellspacing=0 cellpadding=0 width=100%>
        <tr valign=top>
            <td width=0 nowrap>
                <?
                if ($Manufacurer['uplID']) {
                    if (!$Manufacurer['img_not_loaded']) $Manufacurer['file_name'] = "$SITE_ROOT/$Manufacurer[file_name]";
                    if ($Manufacurer['url']) echo "<a href='#' onClick='window.open(\"$Manufacurer[url]\");return false'>";
                    echo "<img src='$Manufacurer[file_name]' width=$Manufacurer[w] height=$Manufacurer[h] alt='$nm'>";
                    if ($Manufacurer['url']) echo "<br><b class=f1>$Manufacurer[url]</b></a>";
                }
                ?>
            </td>
            <td style='text-align:justify' width=100%><?= $Manufacurer['description']; ?></td>

            <?
            if ($Config['cat_show_feat']) {
//-------------------------------------\
                echo '<td width=0 style="padding-left:5">';

                $ModuleData = array(
                    'page' => 0,
                    'pages_url' => '',
                    'head_title' => 'Featured',
                    'mnfID' => $MnfID,
                    'condition' => "((p.price_type=2 and spec_time1<=$TIME and
			(!spec_time2 or spec_time2>=$TIME)) or pn.price_type=2)",
                    'cols' => 1,
                    'rows' => 1
                );

                include('modules/products_search.php');

                echo '</td>';
//-------------------------------------/
            }
            ?>


            <?
            if ($Config['cat_show_spec']) {
//-------------------------------------\
                echo '<td width=0 style="padding-left:5">';

                $ModuleData = array(
                    'page' => 0,
                    'pages_url' => '',
                    'head_title' => 'Specials',
                    'mnfID' => $MnfID,
                    'condition' => "((p.price_type=1 and spec_time1<=$TIME and
			(!spec_time2 or spec_time2>=$TIME)) or pn.price_type=1)",
                    'cols' => 1,
                    'rows' => 1
                );

                include('modules/products_search.php');

                echo '</td>';
//-------------------------------------/
            }
            ?>

        </tr>
    </table>
    <hr width=100% noshade size=1 color=#E5E3E3 align=left>
<?
//---------------------------------------------------------/
}
?>


<?
//-------------------------------------\
$ModuleData = array(
    'page' => $page,
    'pages_url' => $pages_url,
    'head_title' => $PageTitle,
    'mnfID' => $MnfID,
    'show_desc' => 1
);

include('modules/products_search.php');
//-------------------------------------/
?>



<?
    include_once("$ROOT_PATH/common/all_tail.php");
?>
