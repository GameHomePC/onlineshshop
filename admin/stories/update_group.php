<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");



  $priority=call("intval",$priority);
  foreach ($priority as $id=>$pr) {
    $id=(int)$id;
    $act=$active[$id] ? 1 : 0;
    if ($id) db_query("update stories set active=$act,priority=$pr where strID=$id");
    }

  redirect("./?OK=1");
?>