<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


include_once('../../php/MySQLDatabase/MySQLDatabaseConn.php');

function create_new_addr($conn,$info_array)
{
    $query = "";
    
    $conn->query($query);
}

/*
CREATE TABLE addr(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	street VARCHAR(50),
	city VARCHAR(30),
	state_us VARCHAR(30),
	zip CHAR(5)) ENGINE INNODB;
*/
?>
