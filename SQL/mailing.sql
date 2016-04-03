
drop table if exists mailing_emails;
create table mailing_emails (
	emlID int4 unsigned not null auto_increment,
	time int4 unsigned not null,
	active tinyint unsigned not null,
	unsubscribed tinyint unsigned not null,
	email varchar(100) not null,
	name varchar(50) not null,
	
	code int4 unsigned not null,

	primary key (emlID),
	unique (email),
	index (time,active,unsubscribed)
	);


drop table if exists mailing_templates;
create table mailing_templates (
	tplID int4 unsigned not null auto_increment,
	name varchar(100) not null,
	html tinyint unsigned not null,
	subject varchar(100) not null,
	template text not null,

	primary key (tplID)
	);
