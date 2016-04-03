<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");



  $list=implode(',',call('intval',$archive));
  db_query("update news set archive=(nwsID in ($list))");

  redirect("./?OK=1");
?>