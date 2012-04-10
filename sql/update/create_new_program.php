<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('../../php/MySQLDatabase/MySQLDatabaseConn.php');

function create_new_program($conn,$info_array)
{
    $query = "";
    
    $conn->query($query);
    /*
     * Call Create New S & P Contacts
     * Call Create New Issues
     * Call Create New Addr
     */
}

/*
CREATE TABLE program(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	agency INT UNSIGNED NOT NULL,
	addr INT,
	name VARCHAR(20),
	p_contact INT UNSIGNED NOT NULL,
	s_contact INT UNSIGNED NOT NULL,
	descript VARCHAR(400),
	referal BOOL,
	season BINARY(4),
	times BINARY(24),	
	notes VARCHAR(400),
	duration VARCHAR(50)) ENGINE INNODB;
*/
?>
