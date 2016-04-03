
drop table if exists sc_manufacturer;
create table sc_manufacturer (
	mnfID int4 unsigned not null auto_increment,
	uplID int4 unsigned not null,
	name varchar(100) not null,
	url varchar(255) not null,
	content text not null,

	meta_title text not null,
	meta_keywords text not null,
	meta_description text not null,

	primary key (mnfID)
	);


drop table if exists sc_manufacturer_newval;
create table sc_manufacturer_newval (
	mnfID int4 unsigned not null,
	name varchar(100) not null,
	content text not null,

	meta_title text not null,
	meta_keywords text not null,
	meta_description text not null,
	url_name varchar(255) not null,

	primary key (mnfID),
	index(url_name)
	);
