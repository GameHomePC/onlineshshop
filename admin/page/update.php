<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");



  call("intval",array(&$ID,&$type,&$uplID,
		&$pageID1,&$pageID2,&$pageID3,&$pageID4,&$pageID5));
  call("trim",array(&$static_page,&$priority,&$url_name,
		&$meta_title,&$meta_keywords,&$meta_description,&$meta_author,
		&$title,&$content1,&$content2));
  $active=$active ? 1 : 0;
  $in_map=$in_map ? 1 : 0;
  $menuID=call('intval',$menuID);

  if (!$type) $url_name='';

  $static_page_sql=to_sql($static_page);
  $url_name_sql=to_sql($url_name);

  if ($ID<0 || !isset($PAGE_TYPE[$type]))
    $error='Invalid input data';
  elseif ($title=='')
    $error='Enter title';
  elseif (!$type && $static_page=='')
    $error='Enter file with script';
  elseif (!$type && @$sql_num_rows(db_query("select 1 from site_pages
		where pageID!=$ID && !type and static_page='$static_page_sql'")))
    $error='Static page based on this script file already exists';
  elseif ($type==2 && $priority!='' && !is_int(check_int($priority)))
    $error='Wrong value for order';
  elseif (!check_url_name($url_name))
    $error='There are unallowable symbols in Url Name or / in begin or end of it or Url Name is integer';
  elseif ($url_name!='' && @$sql_num_rows(db_query("select 1 from site_pages
		where pageID!=$ID and url_name='$url_name_sql'")))
    $error='Page with this Url Name already exists';
  elseif ($upl && !(($tmp=@getimagesize($upl)) && $tmp[0]<101 && $tmp[1]<101))
    $error='Wrong format or size of banner';
  elseif (($uplIDnew=file_upload($uplID,"upl",$IMG_EXT_LIST,'','uploads/page_banners'))<0)
    $error='Wrong image file or uploading error';
  elseif ($uplIDnew) $uplID=$uplIDnew;
  elseif ($deleteold) $uplID=file_upload($uplID);

  if (isset($error)) {
    include("view.php");
    exit;
    }


  if ($type!=0) $static_page_sql='';
  if ($type==2) $in_map=0;
  else $priority=0; //$active=$priority=0;
  $priority=(int)$priority;
  if ($content1_nl2br) $content1=nl2br($content1);
  if ($content2_nl2br) $content2=nl2br($content2);
  call("to_sql",array(&$priority,&$title,&$content1,&$content2,
		&$meta_title,&$meta_keywords,&$meta_description,&$meta_author));

  if (is_array($bottom_links)) $bottom_links=':'.implode(':',call('intval',$bottom_links)).':';
  else $bottom_links='';

  if (!$ID) {
    db_query("insert into site_pages (type,static_page,active,priority,in_map,url_name,
			meta_title,meta_keywords,meta_description,meta_author,
			title,content1,content2,bottom_links,
			uplID,pageID1,pageID2,pageID3,pageID4,pageID5,last_modified)
		values ($type,'$static_page_sql',$active,$priority,$in_map,'$url_name_sql',
			'$meta_title','$meta_keywords','$meta_description','$meta_author',
			'$title','$content1','$content2','$bottom_links',
			$uplID,$pageID1,$pageID2,$pageID3,$pageID4,$pageID5,$TIME)");
    $ID=@$sql_insert_id();
    }
  else
    db_query("update site_pages set type=$type,static_page='$static_page_sql',
		active=$active,priority=$priority,in_map=$in_map,
		url_name='$url_name_sql',
		meta_title='$meta_title',meta_keywords='$meta_keywords',
		meta_description='$meta_description',meta_author='$meta_author',
		title='$title',content1='$content1',content2='$content2',
		bottom_links='$bottom_links',
		uplID=$uplID,pageID1=$pageID1,pageID2=$pageID2,
		pageID3=$pageID3,pageID4=$pageID4,pageID5=$pageID5,
		last_modified=$TIME
	where pageID=$ID");

// ------------------------------------\
//  $list=implode(',',$menuID);
//  db_query("update site_menu set pageID=$ID,url='' where menuID in ($list)");
// ------------------------------------/

  redirect("./?OK=1");
?>