<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");



  call('intval',array(&$ID,&$col));
  call('trim',array(&$name));
  $categories=call('intval',$categories);
  $active=$active ? 1 : 0;
  $all_pages=$all_pages ? 1 : 0;

  if ($ID<0 || !isset($LIST_COLUMN[$col]))
    $error='Invalid input data';
  elseif ($name=='')
    $error='Enter list name';

  if (isset($error)) {
    include("index.php");
    exit;
    }


  $name=to_sql($name);
  $categories=to_sql(':'.implode(':',$categories).':');

  if (!$ID) {
    db_query("insert into sc_list (name,active,col,all_pages,categories)
		values ('$name',$active,$col,$all_pages,'$categories')");
    $ID=@$sql_insert_id();
    }
  else
    db_query("update sc_list set name='$name',active=$active,col=$col,
			all_pages=$all_pages,categories='$categories'
		where lstID=$ID");

  redirect("./?ID=$ID&OK=1");

?>