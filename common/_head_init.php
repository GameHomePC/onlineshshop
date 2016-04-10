<?php
void();

if (!$PageID) {
    $cond = "CONCAT('$SITE_ROOT/',static_page)='$PHP_SELF'"; // $SCRIPT_NAME
    $PageData = @$sql_fetch_assoc(db_query("select * from site_pages where (active or $view_inactive) and $cond"));
    $PageID = (int)$PageData['pageID'];
}

$k = isset($RedirectUrl);
if ((!$PageID && $CheckPageExisting) || $k) {

    header('HTTP/1.0 404 Not Found');

    if (!$k) $RedirectUrl = ("$SITE_ROOT/map.php" == $PHP_SELF) ?
        "$SITE_ROOT/" : "$SITE_ROOT/map.html";

    $PageTitle = '';
    $Meta['title'] = 'Error 404';
    $Meta['keywords'] = ' ';
    $Meta['description'] = ' ';
}

if ($Meta['title'] != '') $TITLE = $Meta['title'];
elseif ($PageData['meta_title'] != '') $TITLE = $PageData['meta_title'];
elseif ($PageTitle != '') $TITLE = $PageTitle;
elseif ($PageData['title'] != '') $TITLE = $PageData['title'];
elseif ($Config['meta_title'] != '') $TITLE = $Config['meta_title'];

$TITLE = to_html($TITLE);

if (!isset($PageTitle)) $PageTitle = $PageData['title'];

if ($PageData['title'] != '') $NavLineTitle = $PageData['title'];
elseif ($PageTitle != '') $NavLineTitle = $PageTitle;
elseif (($tmp = end(explode('/', get_elem(@parse_url($REQUEST_URI), 'path')))) != '') $NavLineTitle = $tmp;
else $NavLineTitle = 'Index Page';

if (!$tmp_mk = $Meta['keywords'])
    $tmp_mk = ($PageData['meta_keywords'] != '') ? $PageData['meta_keywords'] : $Config['meta_keywords'];
if (!$tmp_md = $Meta['description'])
    $tmp_md = ($PageData['meta_description'] != '') ? $PageData['meta_description'] : $Config['meta_description'];
$tmp_ma = ($PageData['meta_author'] != '') ? $PageData['meta_author'] : $Config['meta_author'];
$Site_head_tags .= "
	<meta name='description' content='" . to_html($tmp_md) . "'>
	<meta name='keywords' content='" . to_html($tmp_mk) . "'>
	<meta name='autor' content='" . to_html($tmp_ma) . "'>
	";

$ActiveCatsOnly = 1;
include_once("$ROOT_PATH/modules/sc_category.php");

$Site_styles[] = "$SITE_ROOT/init_site/css/main.css";
$Site_styles_nn[] = "$SITE_ROOT/init_site/css/main_nn.css";
?>