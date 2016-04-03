<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");



  call("intval",array(&$ID));
  call("trim",array(&$name,&$subject,&$template));
  $html=$html ? 1 : 0;

  if ($ID<0)
    $error='Invalid input data';
  elseif ($name=='')
    $error='Enter template name';

  if (isset($error)) {
    include("index.php");
    exit;
    }


  if ($template_nl2br) $template=nl2br($template);
  call('to_sql',array(&$name,&$subject,&$template));

  if (!$ID) {
    db_query("insert into mailing_templates (name,html,subject,template)
		values ('$name',$html,'$subject','$template')");
//    $ID=@$sql_insert_id();
    }
  else
    db_query("update mailing_templates set name='$name',html=$html,
			subject='$subject',template='$template'
		where tplID=$ID");

  redirect("./?OK=1");
?>