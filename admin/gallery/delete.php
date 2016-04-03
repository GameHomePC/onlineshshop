<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");



  $ID=(int)$ID;
  $page=(int)$page;

  if ($ID>0) {
    file_upload((int)@$sql_result(db_query("select uplID from site_gallery where imgID=$ID"),0,0));
    db_query("delete from site_gallery where imgID=$ID");
    }

  redirect("./?page=$page&OK=1");
?>