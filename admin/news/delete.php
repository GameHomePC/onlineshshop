<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");



  $ID=(int)$ID;

  if ($ID) db_query("delete from news where nwsID=$ID");

  redirect("./?OK=1");
?>