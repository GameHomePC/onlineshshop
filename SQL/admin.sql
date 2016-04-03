

drop table if exists admin;
create table admin (
	admID int4 unsigned not null auto_increment,
	type tinyint unsigned not null,
	login varchar(50) not null,
	password varchar(50) not null,
	email varchar(100) not null,
	question varchar(255) not null,
	answer varchar(255) not null,

	sessID bigint unsigned not null,
	time int4 unsigned not null,
	IP varchar(15) not null,

	primary key (admID),
	unique (login),
	index (sessID),
	index (time)
	);


insert into admin (type,login,password,email,question,answer)
	values (0,'root','root','your_email@your_domain.com','','');


