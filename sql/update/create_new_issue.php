<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * import issues from array and match?
 */



include_once('../../php/MySQLDatabase/MySQLDatabaseConn.php');

function create_new_issue($conn,$info_array)
{
    $query = "";
    
    $conn->query($query);
    
    //query issues
}

/*
CREATE TABLE program_issues(
	program_id INT UNSIGNED NOT NULL,
	issue_id INT UNSIGNED NOT NULL,
	PRIMARY KEY(program_id,issue_id)) ENGINE INNODB;

*/
?>
