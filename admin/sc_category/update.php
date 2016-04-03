<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");


  call('intval',array(&$ID,&$parID));
  call('trim',array(&$name,&$comment,&$meta_title,&$meta_keywords,
		&$meta_description,&$url_name,&$title,&$description,&$priority));
  $active=$active ? 1 : 0;
  $add=$add ? 1 : 0;

  $url_name_sql=to_sql(name_to_url($url_name));

  $list1="$ID";
  do {
    $list1t=$list1;
    $res=db_query("select catID from sc_category
			where catID in ($list1) or parID in ($list1)
			order by 1");
    for ($list1=$t=''; $row=@$sql_fetch_row($res); $t=',') $list1.="$t$row[0]";
    }
  while (strlen($list1)>strlen($list1t));


  if ($ID<2 && !($CAN_ADMIN_CATS && !$ID && $add))
    $error='Invalid input data';
  elseif ($CAN_ADMIN_CATS && !$add && strpos("-,$list1,",",$parID,"))
    $error='You can not move category to its subcategory ;-)';
  elseif ($priority!='' && !is_int(check_int($priority)))
    $error='Wrong value for Order';
  elseif (!check_url_name($url_name))
    $error='There are unallowable symbols in Url Name New or / in begin or end of it or Url Name is integer';
  elseif ($url_name!='') {
    if ($CAN_ADMIN_CATS) {
      if (@$sql_num_rows(db_query("select 1 from sc_category
		where ($add or catID!=$ID) and url_name='$url_name_sql'")))
	$error='Category with this Url Name New already exists';
      }
    elseif ($tmp=@$sql_fetch_row(db_query("select n.catID,c.catID
		from sc_category_newval as n
		     left join sc_category as c on n.catID=c.catID
		where n.catID!=$ID and n.url_name='$url_name_sql'")) )
      if ($tmp[1]) $error='Category with this Url Name New already exists';
      else db_query("update sc_category_newval set url_name='' where catID=$tmp[0]");
    }

  if (isset($error)) {
    include("index.php");
    exit;
    }


  $priority=(int)$priority;
  if ($description_nl2br) $description=nl2br($description);
  call('to_sql',array(&$name,&$comment,
		&$meta_title,&$meta_keywords,&$meta_description,
		&$title,&$description));

  if ($CAN_ADMIN_CATS)
    if ($add) {
      db_query("insert into sc_category (parID,active,priority,name,comment,
			meta_title,meta_keywords,meta_description,url_name,
			title,description)
		values ($parID,$active,$priority,'$name','$comment',
			'$meta_title','$meta_keywords','$meta_description',
			'$url_name_sql','$title','$description')");
      $ID=@$sql_insert_id();
      }
    else
      db_query("update sc_category set parID=$parID,active=$active,
			priority=$priority,
			name='$name',comment='$comment',meta_title='$meta_title',
			meta_keywords='$meta_keywords',
			meta_description='$meta_description',
			url_name='$url_name_sql',
			title='$title',description='$description'
		where catID=$ID");
  else {
    db_query("replace into sc_category_newval (catID,name,comment,meta_title,
			meta_keywords,meta_description,title,description,
			active,priority,url_name)
		values ($ID,'$name','$comment','$meta_title',
			'$meta_keywords','$meta_description',
			'$title','$description',
			$active,$priority,'$url_name_sql')");
    db_query("update sc_category
		set active=$active,priority=$priority,url_name='$url_name_sql'
		where catID=$ID");
    }

//-----------------------------------------------\
sc_category_stat();
if ($SAVE_CATEGORY_TREE_TO_FILE) {
  @include("$ROOT_PATH/modules/categ_items.php");
  }
//-----------------------------------------------/

  redirect("./?ID=$ID&OK=1");
?>