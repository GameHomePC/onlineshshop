<?
// ====================================\
  @include_once('_dir.php');

  $ACCESS_ADMIN_TYPE=array(0,1);
// ====================================/

  include_once("$ROOT_PATH/$ADMIN_DIR/common/authorization.php");


  call('intval',array(&$cat_link_style,&$prd_link_style,
			&$first_page_prods,&$left_menu_style,
			&$additional_percent));
  call('trim',array(
	&$meta_title,&$meta_keywords,&$meta_description,&$meta_author,&$signature,
	&$num_products_feat,&$num_articles,&$num_stories,&$num_news,&$num_news_feat,
	&$site_name,&$contact_email,&$shop_id,&$auto_update_period,
	&$img_cat_cols,&$img_cat_rows,&$http_site_folder,&$https_site_folder,
	&$image_logo,&$order_email,&$descr_preview_num));

  $http_site_folder=rtrim($http_site_folder,'/');
  $https_site_folder=rtrim($https_site_folder,'/');

  if (!$CAT_LINK_STYLE[$cat_link_style] ||
	!$PRD_LINK_STYLE[$prd_link_style] ||
	!isset($FIRST_PAGE_PRODS[$first_page_prods]) ||
	!$LEFT_MENU_STYLE[$left_menu_style] ||
	$additional_percent<1 || $additional_percent>100)
    $error='Incorrect input data';
  elseif ($site_name=='')
    $error='Enter a site name';
  elseif (!check_email($contact_email))
    $error='Wrong contact email';
  elseif (!check_int($shop_id))
    $error='Wrong Shop ID';
  elseif ($auto_update_period!='' && check_int($auto_update_period)===false)
    $error='Wrong auto update base period';
  elseif ($export_portion!='' && check_int($export_portion)===false)
    $error='Wrong expoting items portion';
  elseif ($order_email!='' && !check_email($order_email))
    $error='Wrong email for orders';
  elseif ($http_site_folder!='' && !is_dir($http_site_folder))
    $error='This HTTP Site Root folder does not really exists on server';
  elseif ($https_site_folder!='' && !is_dir($https_site_folder))
    $error='This HTTPS Site Root folder does not really exists on server';
  elseif (!($tmp=check_int($img_cat_cols)) || $tmp>255)
    $error='Wrong number of products per column';
  elseif (!($tmp=check_int($img_cat_rows)) || $tmp>255)
    $error='Wrong number of products per row';
  elseif ($descr_preview_num!='' && check_int($descr_preview_num)===false)
    $error="Wrong number of previewed description's chars";
  elseif (!check_int($num_products_feat))
    $error='Wrong number of products in special blocks';
  elseif (!check_int($num_news))
    $error='Wrong number of news per page';
  elseif ($num_news_feat!='' && check_int($num_news_feat)==false)
    $error='Wrong number of news on Home page';
  elseif (!check_int($num_articles))
    $error='Wrong number of articles per page';
  elseif (!check_int($num_stories))
    $error='Wrong number of live stories per page';

  if (isset($error)) {
    include("home.php");
    exit;
    }


  $get_utf8=$get_utf8 ? 1 : 0;
  $use_https=$use_https ? 1 : 0;
  $show_nav_line=$show_nav_line ? 1 : 0;
  $show_nav_line_last=$show_nav_line_last ? 1 : 0;
  $img_cat_mid=$img_cat_mid ? 1 : 0;
  $img_prd_big=$img_prd_big ? 1 : 0;
  $img_not_load=$img_not_load ? 1 : 0;
  $use_wysiwyg=$use_wysiwyg ? 1 : 0;
  $menu_prd_count=$menu_prd_count ? 1 : 0;
  $show_related_prds=$show_related_prds ? 1 : 0;
  $cat_show_spec=$cat_show_spec ? 1 : 0;
  $cat_show_feat=$cat_show_feat ? 1 : 0;
  $cat_name_to_url=$cat_name_to_url ? 1 : 0;
  $prd_name_to_url=$prd_name_to_url ? 1 : 0;
  $not_export_cats=$not_export_cats ? 1 : 0;
  $show_add_but=$show_add_but ? 1 : 0;
  $show_empty_cats=$show_empty_cats ? 1 : 0;
  $no_external=$no_external ? 1 : 0;

  if ($signature_nl2br) $signature=nl2br($signature);

  call('to_sql',array(&$meta_title,&$meta_keywords,&$meta_description,&$meta_author,
			&$signature,&$site_name,&$contact_email,
			&$http_site_folder,&$https_site_folder,&$image_logo,
			&$order_email));
  call('intval',array(&$shop_id,&$num_products_feat,&$num_articles,
			&$num_stories,&$num_news,&$num_news_feat,
			&$img_cat_cols,&$img_cat_rows,
			&$auto_update_period,&$export_portion,
			&$descr_preview_num));

  db_query("update config set meta_title='$meta_title',meta_keywords='$meta_keywords',
		meta_description='$meta_description',meta_author='$meta_author',
		signature='$signature',auto_update_period=$auto_update_period,
		num_products_feat=$num_products_feat,
		site_name='$site_name',contact_email='$contact_email',
		shop_id=$shop_id,get_utf8=$get_utf8,
		show_nav_line=$show_nav_line,show_nav_line_last=$show_nav_line_last,
		cat_link_style=$cat_link_style,prd_link_style=$prd_link_style,
		cat_name_to_url=$cat_name_to_url,prd_name_to_url=$prd_name_to_url,
		use_https=$use_https,
		img_cat_cols=$img_cat_cols,img_cat_rows=$img_cat_rows,
		img_cat_mid=$img_cat_mid,img_prd_big=$img_prd_big,
		img_not_load=$img_not_load,use_wysiwyg=$use_wysiwyg,
		menu_prd_count=$menu_prd_count,num_news=$num_news,
		num_news_feat=$num_news_feat,
		num_articles=$num_articles,num_stories=$num_stories,
		show_related_prds=$show_related_prds,
		cat_show_spec=$cat_show_spec,cat_show_feat=$cat_show_feat,
		first_page_prods=$first_page_prods,
		http_site_folder='$http_site_folder',
		https_site_folder='$https_site_folder',
		left_menu_style=$left_menu_style,export_portion=$export_portion,
		not_export_cats=$not_export_cats,show_add_but=$show_add_but,
		show_empty_cats=$show_empty_cats,
		additional_percent=$additional_percent,
		image_logo='$image_logo',order_email='$order_email',
		descr_preview_num=$descr_preview_num,
		no_external=$no_external");


//-----------------------------------------------\
if ($k=($not_export_cats && @$sql_num_rows(db_query(
		"select 1 from sc_category limit 1"))))
  db_query("insert IGNORE into sc_category
		(catID,parID,active,priority,name,comment,title)
		values (1,0,0,0,'__TEMP__','System temporary category','__TEMP__')");

if ($SAVE_CATEGORY_TREE_TO_FILE && ($k ||
	$Config['show_empty_cats']!=$show_empty_cats ||
	$Config['cat_link_style']!=$cat_link_style)) {
  $Config['show_empty_cats']=$show_empty_cats;
  $Config['cat_link_style']=$cat_link_style;
  @include("$ROOT_PATH/modules/categ_items.php");

//============= SITEMAP ====================\
 include("$ROOT_PATH/modules/sitemap.php");
//==========================================/
  }
//-----------------------------------------------/

  redirect("home.php?OK=1");
?>