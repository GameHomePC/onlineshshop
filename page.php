<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

// ------------------------------------\
  $PageID=(int)$args[0];
// ------------------------------------/

  $cond=0;
  if ($PageID>0)
    $cond="pageID=$PageID";
  elseif (check_int($url_name))
    $cond="pageID=$url_name";
  elseif ($url_name!='')
    $cond="url_name='".to_sql($url_name)."'";

  if ($cond) {
    $PageData=@$sql_fetch_assoc(db_query("select * from site_pages
		where type and (active or $view_inactive) and $cond"));
    $PageID=(int)$PageData['pageID'];
    }

  if (!$PageID || !$cond) $RedirectUrl="$SITE_ROOT/map.html";

  include_once("$ROOT_PATH/common/all_head.php");
?>



<? /*--- No static content ---*/ ?>


<?
  include_once("$ROOT_PATH/common/all_tail.php");
?>
