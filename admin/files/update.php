<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");



  call("intval",array(&$ID,&$uplID,&$page));
  call("trim",array(&$comment));

  if ($ID<0)
    $error='Invalid input data';
  elseif (($uplIDnew=file_upload($uplID,'upl','','','uploads/uploaded_files',1))<intval($ID<0))
    $error='Wrong file format or uploading error';
  elseif ($uplIDnew) $uplID=$uplIDnew;

  if (isset($error)) {
    include('index.php');
    exit;
    }


  call('to_sql',array(&$comment));

  if (!$ID) {
    db_query("insert into site_uploads (time,uplID,comment)
		values ($TIME,$uplID,'$comment')");
//    $ID=@$sql_insert_id();
    $page=0;
    }
  else               
    db_query("update site_uploads set time=$TIME,uplID=$uplID,comment='$comment'
		where suplID=$ID");

  redirect("./?page=$page&OK=1");
?>