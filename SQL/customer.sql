
drop table if exists customer;
create table customer (
	cstID int4 unsigned not null auto_increment,
	time int4 unsigned not null,
	email varchar(100) not null,
	name varchar(50) not null,

	primary key (cstID),
	unique (email),
	index (time)
	);
