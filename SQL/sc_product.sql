
drop table if exists sc_product;
create table sc_product (
	prdID int4 unsigned not null auto_increment,
	active tinyint unsigned not null default 1,	# актуальное значение с учетом обоих таблиц
	priority tinyint unsigned not null,		# актуальное значение с учетом обоих таблиц

	time_available int4 unsigned not null,
	in_stock tinyint unsigned not null default 1,
	is_new tinyint unsigned null,
	mnfID int4 unsigned not null,
	model varchar(50) not null,
	url varchar(255) not null,

	price_type tinyint unsigned not null,
	price_type_new tinyint unsigned not null,	# актуальное значение с учетом обоих таблиц
	spec_time1 int4 unsigned not null,
	spec_time2 int4 unsigned not null,
	price decimal(10,2) unsigned not null,
	spec_price decimal(10,2) unsigned not null,
	opt1 int4 unsigned not null,
	price1 decimal(10,2) unsigned not null,
	spec_price1 decimal(10,2) unsigned not null,
	opt2 int4 unsigned not null,
	price2 decimal(10,2) unsigned not null,
	spec_price2 decimal(10,2) unsigned not null,

	measure varchar(50) not null,
	dimensions varchar(100) not null,
	weight decimal(10,3) unsigned not null,

	meta_title text not null,
	meta_keywords text not null,
	meta_description text not null,

	uplID1 int4 unsigned not null,
	uplID2 int4 unsigned not null,
	uplID3 int4 unsigned not null,
	uplID4 int4 unsigned not null,
	uplID5 int4 unsigned not null,
	uplID6 int4 unsigned not null,

	doc1 varchar(50) not null,
	docID1 int4 unsigned not null,
	doc2 varchar(50) not null,
	docID2 int4 unsigned not null,
	doc3 varchar(50) not null,
	docID3 int4 unsigned not null,

	name varchar(100) not null,
	comment varchar(255) not null,
	description text not null,

	attributes text not null,

	quantity int4 unsigned not null,
	num_choosed int4 unsigned not null,

	last_modified int4 unsigned not null,

	primary key (prdID),
	index (active,time_available),
	index (active,is_new),
	index (price_type_new,priority,is_new),
	index (priority),
	index (num_choosed,price_type_new,priority),
	index (is_new)
	);


drop table if exists sc_product_newval;
create table sc_product_newval (
	prdID int4 unsigned not null,
	active tinyint unsigned not null default 1,
	priority tinyint unsigned not null,

	price_type tinyint unsigned not null,

	meta_title text not null,
	meta_keywords text not null,
	meta_description text not null,
	url_name varchar(255) not null,

	name varchar(100) not null,
	comment varchar(255) not null,
	description text not null,

	last_modified int4 unsigned not null,

	primary key (prdID)
	);
