CREATE DATABASE give_ctr_agencies;
USE give_ctr_agencies;

CREATE TABLE student_contact(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
	l_name VARCHAR(20),
	f_name VARCHAR(20),
	m_name VARCHAR(20),
	suf CHAR(3),
	m_phone CHAR(9),
	w_phone CHAR(9),
	mail VARCHAR(40)) ENGINE INNODB;
	
CREATE TABLE pro_contact(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
	title VARCHAR(30),
	l_name VARCHAR(30),
	f_name VARCHAR(30),
	m_name VARCHAR(30),
	suf CHAR(3),
	m_phone CHAR(9),
	w_phone CHAR(9),
	mail VARCHAR(40) ENGINE INNODB;
	
CREATE TABLE contact_history(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
	contact_id INT,
	program_id INT) ENGINE INNODB;
	
CREATE TABLE addr(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	street VARCHAR(50),
	city VARCHAR(30),
	state VARCHAR(30),
	zip CHAR(5)) ENGINE INNODB;
	
CREATE TABLE agency(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(20),
	descript VARCHAR(1000),
	p_contact_id INT UNSIGNED, 
	addr INT UNSIGNED,
	mail VARCHAR(40),
	phone CHAR(9),
	fax CHAR(9)) ENGINE INNODB;
	
CREATE TABLE program(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	agency INT UNSIGNED NOT NULL,
	addr INT;
	name VARCHAR(20),
	p_contact
	s_contact
	descript VARCHAR(400),
	referal BOOL,
	season BINARY(4),
	times BINARY(24),	
	notes VARCHAR(400),
	issues BINARY(40),
	duration VARCHAR(50)) ENGINE INNODB;
	
CREATE TABLE issues
