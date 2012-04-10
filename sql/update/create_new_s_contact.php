<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('../../php/MySQLDatabase/MySQLDatabaseConn.php');

function create_new_s_contact($conn,$info_array)
{
    $query = "";
    
    $conn->query($query);
}

/*
 CREATE TABLE contact_history(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
	contact_id INT,
	program_id INT) ENGINE INNODB;
 
 CREATE TABLE student_contact(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
	l_name VARCHAR(20),
	f_name VARCHAR(20),
	m_name VARCHAR(20),
	suf CHAR(3),
	m_phone CHAR(10),
	w_phone CHAR(10),
	mail VARCHAR(40)) ENGINE INNODB;
 */
?>
