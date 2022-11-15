CREATE DATABASE learn_and_help_db;

USE learn_and_help_db;

CREATE TABLE registrations
	(Reg_Id int NOT NULL AUTO_INCREMENT,
	Sponsor_Name varchar(50),
	Sponsor_Email varchar(50),
	Sponsor_Phone_Number varchar(15),
	Spouse_Name varchar(50),
	Spouse_Email varchar(50),
	Spouse_Phone_Number varchar(15),
	Student_Name varchar(50),
	Student_Email varchar(50),
	Student_Phone_Number varchar(15),
	Class varchar(20),
	Cause varchar(20),
	Modified_Time date,
	Created_Time date,
	PRIMARY KEY (Reg_Id));


INSERT INTO registrations
	values
	(NULL, "Al", "Coholic", "1234567890", "Seymour", "Butz", "2345678901", "Mike", "Rotch", "3456789012", "Python", "Library", SYSDATE(), SYSDATE()),
	(NULL, "Hugh", "Jass", "1234567890", "Ivana", "Tinkle", "2345678901", "Anita", "Bath", "3456789012", "Python", "Digital Classroom", SYSDATE(), SYSDATE()),
	(NULL, "Yuri", "Nator", "1234567890", "Moe", "Ron", "2345678901", "Pierre", "Pants", "3456789012", "Java", "Library", SYSDATE(), SYSDATE());



CREATE TABLE users (
	User_Id int NOT NULL AUTO_INCREMENT,
	First_Name varchar(30),
	Last_Name varchar(30),
	Email varchar(75),
	Hash varchar(200),
	Active varchar(10),
	Role varchar(20),
	Modified_Time date,
  Created_Time date,
	PRIMARY KEY (User_Id));



INSERT INTO users
	values
	(NULL, 'Siva', 'Jasthi', 'siva@silcmn.com', '$2y$10$zFAG5GBNtf.5BpowMqZSputSLeG8OzfKACpjAMsePjZhu.TnvU/Bu', 'yes', 'admin', SYSDATE(), SYSDATE()),
  (NULL, 'NotSiva', 'Jasthi', 'siva@silcmn.com', '$2y$10$zFAG5GBNtf.5BpowMqZSputSLeG8OzfKACpjAMsePjZhu.TnvU/Bu', 'yes', 'admin', SYSDATE(), SYSDATE());

CREATE TABLE blogs (
	Blog_Id int NOT NULL AUTO_INCREMENT,
	Title varchar(100),
	Author varchar(50),
	Description TEXT,
	Video_Link varchar(200),
	Modified_Time DATETIME,
	Created_Time DATETIME,
	PRIMARY KEY (Blog_Id));

CREATE TABLE blog_pictures (
	Picture_Id int NOT NULL AUTO_INCREMENT,
	Blog_Id int,
	Location varchar(100),
	PRIMARY KEY (Picture_Id),
	FOREIGN KEY (Blog_Id) REFERENCES blogs(Blog_Id));

CREATE TABLE causes (
	Cause_Id int NOT NULL AUTO_INCREMENT,
	Cause_name VARCHAR(100),
	description TEXT,
	URL VARCHAR(150),
	Contact_name VARCHAR(50),
	Contact_email VARCHAR(50),
	Contact_phone VARCHAR(15),
	PRIMARY KEY (Cause_Id)
);

INSERT INTO causes
values (
	NULL,
	'Cause1',
	'Description1',
	'www.cause2.com',
	'Con Tactname',
	'con@cause1.com',
	'123-456-7890'
	),
	(
	NULL,
	'Cause2',
	'Description2',
	'www.cause2.com',
	'Conta Ctname',
	'ctname@cause2.com',
	'123-456-7890'
	);
