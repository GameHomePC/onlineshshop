<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");


  $priority=call('intval',$priority);
  foreach ($priority as $id=>$pr) {
    $id=(int)$id;
    $act=$active[$id] ? 1 : 0;
    $inm=$in_map[$id] ? 1 : 0;
    if ($id) db_query("update site_pages set active=$act,
				priority=IF(type=2,$pr,0),
				in_map=IF(type<2,$inm,0)
			where pageID=$id");
    }

  redirect("./?OK=1");
?>