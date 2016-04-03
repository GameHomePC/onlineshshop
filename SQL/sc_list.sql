
drop table if exists sc_list;
create table sc_list (
	lstID int4 unsigned not null auto_increment,
	name varchar(50) not null,
	products text not null,

	active tinyint unsigned not null,
	col tinyint unsigned not null,
	all_pages tinyint unsigned not null,
	categories text,

	primary key (lstID)
	);
