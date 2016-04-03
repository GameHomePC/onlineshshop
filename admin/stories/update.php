<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");



  call("intval",array(&$ID));
  call("trim",array(&$priority,&$title,&$content));
  $active=$active ? 1 : 0;

  if ($ID<0)
    $error='Invalid input data';
  elseif ($priority!='' && !is_int(check_int($priority)))
    $error='Wrong value for order';
  elseif ($title=='')
    $error='Enter story title';
  elseif ($content=='')
    $error='Enter story content';

  if (isset($error)) {
    include("view.php");
    exit;
    }


  $priority=(int)$priority;
  if ($content_nl2br) $content=nl2br($content);
  call('to_sql',array(&$title,&$content));

  if (!$ID) {
    db_query("insert into stories (active,priority,title,content)
		values ($active,$priority,'$title','$content')");
//    $ID=@$sql_insert_id();
    }
  else
    db_query("update stories set active=$active,priority=$priority,
			title='$title',content='$content'
		where strID=$ID");

  redirect("./?OK=1");
?>