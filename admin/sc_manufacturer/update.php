<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");


  call('intval',array(&$ID));
  call('trim',array(&$name,&$content,&$meta_title,&$meta_keywords,
			&$meta_description,&$url_name));
  $url_name_sql=to_sql(name_to_url($url_name));


  if ($ID<1)
    $error='Invalid input data';
  elseif (!check_url_name($url_name))
    $error='There are unallowable symbols in Url Name New or / in begin or end of it or Url Name is integer';
  elseif ($url_name!='' &&
	  $tmp=@$sql_fetch_row(db_query("select n.mnfID,m.mnfID
		from sc_manufacturer_newval as n
		     left join sc_manufacturer as m on n.mnfID=m.mnfID
		where n.mnfID!=$ID and n.url_name='$url_name_sql'")) )
    if ($tmp[1]) $error='Manufacturer with this Url Name New already exists';
    else db_query("update sc_manufacturer_newval set url_name='' where mnfID=$tmp[0]");


  if (isset($error)) {
    include('index.php');
    exit;
    }


  if ($content_nl2br) $content=nl2br($content);
  call('to_sql',array(&$name,&$content,&$meta_title,&$meta_keywords,
			&$meta_description));

  db_query("replace into sc_manufacturer_newval (mnfID,name,content,meta_title,
			meta_keywords,meta_description,url_name)
		values ($ID,'$name','$content','$meta_title',
			'$meta_keywords','$meta_description','$url_name_sql')");


  redirect("index.php?ID=$ID&OK=1");
?>