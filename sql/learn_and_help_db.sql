CREATE DATABASE learn_and_help_db;

USE learn_and_help_db;

CREATE TABLE classes (
     Class_Id int NOT NULL AUTO_INCREMENT,
     Class_Name varchar(30),
     Teacher_Id int,
     PRIMARY KEY (Class_Id));

INSERT INTO classes
values
    (1, 'Java 101', 1),
    (2, 'Python 101', 1),
    (3, 'Java 201', 2),
    (4, 'Python 201', 2);

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
	Class_Id int,
	Cause varchar(20),
	Modified_Time date,
	Created_Time date,
	PRIMARY KEY (Reg_Id),
	FOREIGN KEY (Class_Id) REFERENCES classes(Class_Id));


INSERT INTO registrations
	values
	(1, 'Al', 'Coholic', '123-456-7890', 'Seymour', 'Butz', '234-567-8901', 'a', 'a@a.a', '922-222-2222', 1, 'Library', SYSDATE(), SYSDATE()),
	(2, 'Hugh', 'Jass', '123-456-7890', 'Ivana', 'Tinkle', '234-567-8901', 'b', 'b@b.b', '222-222-2222', 1, 'Digital Classroom', SYSDATE(), SYSDATE()),
	(3, 'Yuri', 'Nator', '123-456-7890', 'Moe', 'Ron', '234-567-8901', 'c', 'c@c.c', '222-222-2222', 2, 'Library', SYSDATE(), SYSDATE());

CREATE TABLE users (
	User_Id int NOT NULL AUTO_INCREMENT,
	First_Name varchar(30),
	Last_Name varchar(30),
	Email varchar(75),
	Phone varchar(15),
	Hash varchar(200),
	Active varchar(10),
	Role varchar(20),
	Modified_Time date,
    Created_Time date,
	PRIMARY KEY (User_Id));

INSERT INTO users
	values
		(1, 'Siva', 'Jasthi', 'siva@silcmn.com', '123-456-7890', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'yes', 'admin', SYSDATE(), SYSDATE()),
  	(2, 'Ishana', 'Didwania', 'ishana@silcmn.com', '123-456-7890', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'yes', 'admin', SYSDATE(), SYSDATE()),
  	(3, 'Mike', 'Rotch', 'mikerotch@school.com', '123-456-7890', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'yes', 'student', SYSDATE(), SYSDATE()),
  	(4, 'Anita', 'Bath', 'anitabath@school.com', '123-456-7890', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'yes', 'student', SYSDATE(), SYSDATE()),
    (5, 'Pierre', 'Pants', 'pierrepants@school.com', '123-456-7890', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'yes', 'student', SYSDATE(), SYSDATE());

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
