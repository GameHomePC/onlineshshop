
drop table if exists stories;
create table stories (
	strID int4 unsigned not null auto_increment,
	active tinyint unsigned not null,
	priority tinyint unsigned not null,
	title varchar(255) not null,
	content text not null,

	primary key (strID)
	);
