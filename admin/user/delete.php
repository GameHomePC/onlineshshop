<?
// ====================================\
  @include_once('_dir.php');
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");



  $ID=(int)$ID;

  if ($ID>1) db_query("delete from admin where admID=$ID and type>$Type");

  redirect("./?OK=1");
?>