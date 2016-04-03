
drop table if exists news;
create table news (
	nwsID int4 unsigned not null auto_increment,
	archive tinyint unsigned not null,
	time int4 unsigned not null,
	title varchar(255) not null,
	content text not null,
	source varchar(255) not null,

	primary key (nwsID),
	index (time)
	);
