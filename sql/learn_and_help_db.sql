CREATE DATABASE learn_and_help_db;

USE learn_and_help_db;

CREATE TABLE Registrations 
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

 
INSERT INTO Registrations
	values
	(NULL, "Al", "Coholic", "1234567890", "Seymour", "Butz", "2345678901", "Mike", "Rotch", "3456789012", "Python", "Library", SYSDATE(), SYSDATE()),
	(NULL, "Hugh", "Jass", "1234567890", "Ivana", "Tinkle", "2345678901", "Anita", "Bath", "3456789012", "Python", "Digital Classroom", SYSDATE(), SYSDATE()),
	(NULL, "Yuri", "Nator", "1234567890", "Moe", "Ron", "2345678901", "Pierre", "Pants", "3456789012", "Java", "Library", SYSDATE(), SYSDATE());



CREATE TABLE Users (
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



INSERT INTO Users
	values
	(NULL, 'Siva', 'Jasthi', 'siva@silcmn.com', '$2y$10$zFAG5GBNtf.5BpowMqZSputSLeG8OzfKACpjAMsePjZhu.TnvU/Bu', 'yes', 'admin', SYSDATE(), SYSDATE()),
    	(NULL, 'NotSiva', 'Jasthi', 'siva@silcmn.com', '$2y$10$zFAG5GBNtf.5BpowMqZSputSLeG8OzfKACpjAMsePjZhu.TnvU/Bu', 'yes', 'admin', SYSDATE(), SYSDATE());