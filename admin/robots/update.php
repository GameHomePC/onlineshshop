<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");



  $f=fopen("$ROOT_PATH/robots.txt",'wb');
  fputs($f,$content);
  fclose($f);

  redirect("./?OK=1");
?>