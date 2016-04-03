<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");



  call("intval",array(&$ID,&$uplID));
  call("trim",array(&$priority,&$name,&$url,&$content));
  $active=$active ? 1 : 0;
  $url_js=$url_js ? 1 : 0;

  if ($ID<0)
    $error='Invalid input data';
  elseif ($priority!='' && !is_int(check_int($priority)))
    $error='Wrong value for order';
  elseif ($name=='')
    $error='Enter link title';
//  elseif ($content=='')
//    $error='Enter comment';
  elseif ($upl && !(($tmp=@getimagesize($upl)) && $tmp[0]<201 && $tmp[1]<201))
    $error='Wrong image format or size';
  elseif (($uplIDnew=file_upload($uplID,'upl',$IMG_EXT_LIST,'','uploads/links'))<0)
    $error='Wrong image file or uploading error';
  elseif ($uplIDnew) $uplID=$uplIDnew;
  elseif ($deleteold) $uplID=file_upload($uplID);

  if (isset($error)) {
    include("view.php");
    exit;
    }


  $priority=(int)$priority;
  if ($content_nl2br) $content=nl2br($content);
  call('to_sql',array(&$name,&$url,&$content));

  if (!$ID) {
    db_query("insert into links (active,priority,uplID,name,url,url_js,content)
		values ($active,$priority,$uplID,'$name','$url',$url_js,'$content')");
//    $ID=@$sql_insert_id();
    }
  else
    db_query("update links set active=$active,priority=$priority,
			uplID=$uplID,name='$name',url='$url',url_js=$url_js,
			content='$content'
		where lnkID=$ID");

  redirect("./?OK=1");
?>