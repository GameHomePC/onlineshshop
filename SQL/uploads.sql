
drop table if exists uploads;
create table uploads (
	uplID int4 unsigned not null auto_increment,
	path varchar(255),
	name varchar(255),
	save_name tinyint unsigned not null,

	primary key (uplID)
	);


drop table if exists uploads1;
create table uploads1 (
	uplID int4 unsigned not null auto_increment,
	path varchar(255),
	name varchar(255),
	width int4 unsigned not null,
	height int4 unsigned not null,
	img_not_loaded tinyint unsigned not null,

	primary key (uplID)
	);


drop table if exists file_size;
create table file_size (
	obj_type int4 unsigned not null,	# 0 - mnf, 1 - cat, 2 - prd
	objID int4 unsigned not null,
	num tinyint unsigned not null,
	size int4 unsigned not null,

	primary key (obj_type,objID,num)
	);

