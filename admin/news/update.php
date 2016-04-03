<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");



  call("intval",array(&$ID,&$td,&$tm,&$ty));
  call("trim",array(&$title,&$content,&$source));
  $archive=$archive ? 1 : 0;

  if ($ID<0)
    $error='Invalid input data';
  elseif ($title=='')
    $error='Enter title';
  elseif ($content=='')
    $error='Enter content';

  if (isset($error)) {
    include("view.php");
    exit;
    }


  $time=mktime(0,0,0,$tm,$td,$ty)-$GMT_DIFF;
  if ($content_nl2br) $content=nl2br($content);
  call('to_sql',array(&$title,&$content,&$source));

  if (!$ID)
    db_query("insert into news (archive,time,title,content,source)
		values ($archive,$time,'$title','$content','$source')");
  else
    db_query("update news set archive=$archive,time=$time,title='$title',
			content='$content',source='$source'
		where nwsID=$ID");

  redirect("./?OK=1");
?>