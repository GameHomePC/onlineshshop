<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");



  $ID=(int)$ID;

  if ($ID>0) {
    file_upload((int)@$sql_result(db_query("select uplID from links where lnkID=$ID"),0,0));
    db_query("delete from links where lnkID=$ID");
    }

  redirect("./?OK=1");
?>