
drop table if exists session;
create table session (
	ID char(32) not null,
	time int4 unsigned not null,
	data text not null,

	primary key (ID),
	index (time)
	);
