
drop table if exists config;
create table config (
	confID int4 unsigned not null auto_increment,

	meta_title varchar(100) not null,
	meta_keywords text not null,
	meta_description text not null,
	meta_author varchar(100) not null,

	signature text not null,

	shop_id int4 unsigned not null,
	get_utf8 tinyint unsigned not null,
	no_external tinyint unsigned not null,

	use_https tinyint unsigned not null,
	http_site_folder varchar(255) not null,
	https_site_folder varchar(255) not null,

	num_products_feat int4 unsigned not null,
	num_articles int4 unsigned not null,
	num_stories int4 unsigned not null,
	num_news int4 unsigned not null,
	num_news_feat int4 unsigned not null,

	site_name varchar(100) not null,
	contact_email varchar(100) not null,

	auto_update_period int4 unsigned not null,
	last_time_updating int4 unsigned not null,
	last_time_updated int4 unsigned not null,

	show_nav_line tinyint unsigned not null,
	show_nav_line_last tinyint unsigned not null,

	cat_link_style tinyint unsigned not null,
	prd_link_style tinyint unsigned not null,
	cat_name_to_url tinyint unsigned not null,
	prd_name_to_url tinyint unsigned not null,

	menu_prd_count tinyint unsigned not null,
	show_empty_cats tinyint unsigned not null,

	img_cat_cols tinyint unsigned not null,
	img_cat_rows tinyint unsigned not null,
	img_cat_mid tinyint unsigned not null,
	img_prd_big tinyint unsigned not null,
	img_not_load tinyint unsigned not null,

	use_wysiwyg tinyint unsigned not null,

	show_related_prds tinyint unsigned not null,

	cat_show_spec tinyint unsigned not null,
	cat_show_feat tinyint unsigned not null,

	first_page_prods tinyint unsigned not null,
	left_menu_style tinyint unsigned not null,

	export_portion int4 unsigned not null,
	not_export_cats tinyint unsigned not null,
	show_add_but tinyint unsigned not null,

	additional_percent tinyint unsigned not null,

	image_logo varchar(50) not null,
	image_logo_old varchar(50) not null,

	order_email varchar(100) not null,

	descr_preview_num int unsigned not null,

	primary key (confID)
	);

insert into config (confID) values (1);

