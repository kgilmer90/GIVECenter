<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * Recursively remove objects associated with it
 */

function remove_program($conn,$p_id){
    $query = "DELETE FROM program
        WHERE id = $p_id";
    
    $conn->query($query);
}

/*CREATE TABLE program(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    agency INT UNSIGNED NOT NULL,
    addr INT,
    name VARCHAR(20),
    p_contact INT UNSIGNED NOT NULL,
    s_contact INT UNSIGNED NOT NULL,
    descript VARCHAR(400),
    referal BOOL,
    notes VARCHAR(400),
    duration VARCHAR(50)) ENGINE INNODB;*/
?>
