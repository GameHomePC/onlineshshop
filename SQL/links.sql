
drop table if exists links;
create table links (
	lnkID int4 unsigned not null auto_increment,
	active tinyint unsigned not null,
	priority tinyint unsigned not null,
	uplID int4 unsigned not null,
	name varchar(100) not null,
	url varchar(255) not null,
	url_js tinyint unsigned not null,
	content text not null,

	primary key (lnkID)
	);
