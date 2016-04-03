<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");


  call('intval',array(&$ID,$price_type));
  call('trim',array(&$name,&$comment,&$meta_title,&$meta_keywords,
		&$meta_description,&$url_name,&$description,&$priority));
  $active=$active ? 1 : 0;

  $url_name_sql=to_sql(name_to_url($url_name));

  if ($ID<1 || !isset($PRICE_TYPE[$price_type]))
    $error='Invalid input data';
  elseif ($priority!='' && !is_int(check_int($priority)))
    $error='Wrong value for Order';
  elseif (!check_url_name($url_name))
    $error='There are unallowable symbols in Url Name New or / in begin or end of it or Url Name is integer';
  elseif ($url_name!='' &&
	  $tmp=@$sql_fetch_row(db_query("select n.prdID,p.prdID
		from sc_product_newval as n
		     left join sc_product as p on n.prdID=p.prdID
		where n.prdID!=$ID and n.url_name='$url_name_sql'")) )
    if ($tmp[1]) $error='Product with this Url Name New already exists';
    else db_query("update sc_product_newval set url_name='' where prdID=$tmp[0]");


  if (isset($error)) {
    include('view.php');
    exit;
    }


  $priority=(int)$priority;
  if ($description_nl2br) $description=nl2br($description);
  call('to_sql',array(&$name,&$comment,&$meta_title,&$meta_keywords,
			&$meta_description,&$description));

  db_query("replace into sc_product_newval (prdID,name,comment,meta_title,
			meta_keywords,meta_description,url_name,description,
			active,priority,price_type,last_modified)
		values ($ID,'$name','$comment','$meta_title',
			'$meta_keywords','$meta_description','$url_name_sql',
			'$description',$active,$priority,$price_type,$TIME)");
  db_query("update sc_product set active=$active,priority=$priority,
			price_type_new=IF(price_type,price_type,$price_type)
		where prdID=$ID");

//-----------------------------------------------\
sc_category_stat();
if ($SAVE_CATEGORY_TREE_TO_FILE) {
  @include("$ROOT_PATH/modules/categ_items.php");
  }
//-----------------------------------------------/


  $end_url_url=to_url(trim($end_url));

  redirect("view.php?ID=$ID&OK=1&end_url=$end_url_url");
?>