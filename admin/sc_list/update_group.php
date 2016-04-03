<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");



  $col=call('intval',$col);
  foreach ($col as $id => $column) {
    $id=(int)$id;
    $column=(int)$column;
    if (!$LIST_COLUMN[$column]) $column=0;
    $act=$active[$id] ? 1 : 0;
    $all=$all_pages[$id] ? 1 : 0;
    if ($id) db_query("update sc_list set active=$act,col=$column,all_pages=$all
		where lstID=$id");
    }

  redirect("./?OK=1");
?>