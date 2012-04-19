<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *  Delete Hours from Program
 * @param type $conn
 * @param type $program_id 
 */

function delete_hours($conn,$program_id)
{
    $query1="DELETE FROM program_hours
            WHERE program_id = $program_id";
    $conn->query($query1);
}

/*CREATE TABLE program_hours(
    hours_id INT UNSIGNED NOT NULL,
    program_id INT UNSIGNED NOT NULL,
    PRIMARY KEY(hours_id,program_id)) ENGINE INNODB;*/
?>
