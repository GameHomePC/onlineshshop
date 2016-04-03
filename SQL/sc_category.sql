
drop table if exists sc_category;
create table sc_category (
	catID int4 unsigned not null auto_increment,
	parID int4 unsigned not null,
	active tinyint unsigned not null default 1,	# актуальное значение с учетом обоих таблиц
	priority tinyint unsigned not null,		# актуальное значение с учетом обоих таблиц

	name varchar(100) not null,
	comment varchar(255) not null,

	meta_title text not null,
	meta_keywords text not null,
	meta_description text not null,
	url_name varchar(255) not null,			# актуальное значение с учетом обоих таблиц

	uplID int4 unsigned not null,
	title varchar(100) not null,
	description text not null,

	primary key (catID),
	index (parID,priority,catID),
	index (active),
	index (url_name)
	);


drop table if exists sc_category_newval;
create table sc_category_newval (
	catID int4 unsigned not null,
	active tinyint unsigned not null default 1,
	priority tinyint unsigned not null,

	name varchar(100) not null,
	comment varchar(255) not null,

	meta_title text not null,
	meta_keywords text not null,
	meta_description text not null,
	url_name varchar(255) not null,

	title varchar(100) not null,
	description text not null,

	primary key (catID),
	index (url_name)
	);


drop table if exists sc_category_prod;
create table sc_category_prod (
	catID int4 unsigned not null,
	prdID int4 unsigned not null,

	primary key (catID,prdID),
	index (prdID)
	);


drop table if exists sc_category_stat;
create table sc_category_stat (
	catID int4 unsigned not null,
	n_prod int4 unsigned not null,
	n_prod_all int4 unsigned not null,
	last_time int4 unsigned not null,
	has_new tinyint unsigned not null,

	primary key (catID)
	);


