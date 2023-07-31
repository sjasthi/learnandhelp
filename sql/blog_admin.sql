USE learn_and_help_db;

CREATE TABLE blog_admin (
	admin_Id int NOT NULL AUTO_INCREMENT,
	school_id int(11),
	contact_email varchar(50),
	school_name varchar(50),
	category varchar(50),
	username varchar(50),
	passwd varchar(50),
	PRIMARY KEY (admin_Id)
	);

