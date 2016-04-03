
drop table if exists site_gallery;
create table site_gallery (
	imgID int4 unsigned not null auto_increment,
	time int4 unsigned not null,
	uplID int4 unsigned not null,
	comment varchar(50) not null,
	alt varchar(50) not null,
	width int4 not null,
	height int4 not null,

	primary key (imgID),
	index (time)
	);


drop table if exists site_uploads;
create table site_uploads (
	suplID int4 unsigned not null auto_increment,
	time int4 unsigned not null,
	uplID int4 unsigned not null,
	comment varchar(50) not null,

	primary key (suplID),
	index (time)
	);


drop table if exists site_menu;
create table site_menu (
	menuID int4 unsigned not null auto_increment,
	parID int4 unsigned not null,
	static tinyint unsigned not null,
	priority tinyint unsigned not null,
	title varchar(100) not null,
	pageID int4 unsigned not null,
	url varchar(255) not null,
	newwin tinyint unsigned not null,

	primary key (menuID),
	index (parID,priority,menuID)
	);


drop table if exists site_pages;
create table site_pages (
	pageID int4 unsigned not null auto_increment,
	type tinyint unsigned not null,

	static_page varchar(100) not null,	# Only for static pages

	active tinyint unsigned not null,	# Only for articles (type 2)
	priority tinyint unsigned not null,	# Only for articles (type 2)
	in_map tinyint unsigned not null,

	url_name varchar(255) not null,

	meta_title text not null,
	meta_keywords text not null,
	meta_description text not null,
	meta_author varchar(100) not null,

	title varchar(100) not null,
	content1 text not null,
	content2 text not null,
	bottom_links varchar(255) not null,	# Format: ':12:23:32:...:45:'

	uplID int4 unsigned not null,		# Banner
	pageID1 int4 unsigned not null,		# Right Banners
	pageID2 int4 unsigned not null,
	pageID3 int4 unsigned not null,
	pageID4 int4 unsigned not null,
	pageID5 int4 unsigned not null,

	last_modified int4 unsigned not null,

	primary key (pageID),
	index (type,priority)
	);
