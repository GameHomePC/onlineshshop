<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");



  call("intval",array(&$ID,&$uplID,&$page));
  call("trim",array(&$comment,&$alt));

  if ($ID<0)
    $error='Invalid input data';
  elseif (($uplIDnew=file_upload($uplID,'upl',$IMG_EXT_LIST,'','uploads/gallery',1))<intval($ID<0))
    $error='Wrong image file or uploading error';
  elseif ($uplIDnew) $uplID=$uplIDnew;

  if (isset($error)) {
    include('index.php');
    exit;
    }


  if ($uplIDnew)
    list($width,$height)=@getimagesize("$SERVER_ROOT/".get_elem(file_name($uplIDnew),'full_name'));
  else {
    $width='width';
    $height='height';
    }
  call('to_sql',array(&$comment,&$alt));

  if (!$ID) {
    db_query("insert into site_gallery (time,uplID,comment,alt,width,height)
		values ($TIME,$uplID,'$comment','$alt',$width,$height)");
//    $ID=@$sql_insert_id();
    $page=0;
    }
  else
    db_query("update site_gallery set time=$TIME,uplID=$uplID,
		comment='$comment',alt='$alt',width=$width,height=$height
		where imgID=$ID");

  redirect("./?page=$page&OK=1");
?>