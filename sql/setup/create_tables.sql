USE give_ctr_agencies;

CREATE TABLE addr(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    street VARCHAR(50),
    city VARCHAR(30),
    state_us VARCHAR(30),
    zip CHAR(5)) ENGINE INNODB;

CREATE TABLE agency(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    descript VARCHAR(1000),
    p_contact_id INT UNSIGNED, 
    addr INT UNSIGNED,
    mail VARCHAR(40),
    phone CHAR(10),
    fax CHAR(10)) ENGINE INNODB;

CREATE TABLE contact_history(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
    contact_id INT,
    program_id INT) ENGINE INNODB;
	
CREATE TABLE image_paths(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    image_type VARCHAR(20),
    path VARCHAR(50),
    name VARCHAR(20)) ENGINE INNODB;

CREATE TABLE hours(
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    hours VARCHAR(10) NOT NULL) ENGINE INNODB;
	
CREATE TABLE issues(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20)) ENGINE INNODB;
	
CREATE TABLE pro_contact(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
    title VARCHAR(30),
    l_name VARCHAR(30),
    f_name VARCHAR(30),
    m_name VARCHAR(30),
    suf VARCHAR(3),
    m_phone CHAR(10),
    w_phone CHAR(10),
    mail VARCHAR(40)) ENGINE INNODB;

CREATE TABLE program(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    agency INT UNSIGNED NOT NULL,
    addr INT,
    name VARCHAR(50),
    p_contact INT UNSIGNED NOT NULL,
    s_contact INT UNSIGNED NOT NULL,
    descript VARCHAR(400),
    referal BOOL,
    notes VARCHAR(400),
    duration VARCHAR(50)) ENGINE INNODB;

CREATE TABLE program_hours(
    hours_id INT UNSIGNED NOT NULL,
    program_id INT UNSIGNED NOT NULL,
    PRIMARY KEY(hours_id,program_id)) ENGINE INNODB;

CREATE TABLE program_issues(
    program_id INT UNSIGNED NOT NULL,
    issue_id INT UNSIGNED NOT NULL,
    PRIMARY KEY(program_id,issue_id)) ENGINE INNODB;

CREATE TABLE program_seasons(
    program_id INT UNSIGNED,
    season_id INT UNSIGNED,
    PRIMARY KEY(program_id,season_id)) ENGINE INNODB;

CREATE TABLE seasons(
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    season VARCHAR(10)) ENGINE INNODB;    

CREATE TABLE student_contact(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
    l_name VARCHAR(30),
    f_name VARCHAR(30),
    m_name VARCHAR(30),
    suf CHAR(3),
    m_phone CHAR(10),
    w_phone CHAR(10),
    mail VARCHAR(40)) ENGINE INNODB;

CREATE TABLE users(
    uname VARCHAR(30) NOT NULL,
    passwd VARCHAR(32),
    PRIMARY KEY(uname,passwd)) ENGINE INNODB;