<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");



  $active_old=call("intval",$active_old);
  $list='0';
  foreach ($active_old as $id=>$act)
    if ($active[$id]!=$act) $list.=','.intval($id);
  db_query("update mailing_emails set active=1-active where emlID in ($list)");

  redirect("./?$QUERY&OK=1");
?>