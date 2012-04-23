<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *  Finds and Displays Hours for Specific Program
 * @param type $conn    database connection
 * @param type $program_id  program to get hours for
 * @return $results     numeric array of the values of hours 
 */
function create_hours($conn,$program_id)
{
    $query = "SELECT hours.id
        FROM hours,program_hours
        WHERE program_hours.program_id = $program_id AND program_hours.hours_id = hours.id";
    $conn->query($query);
    
    if($conn->numRows()==0){
        return null;
    }
    $results = $conn->fetchAllAsNumeric();
    
    return $results;   
}
/*
CREATE TABLE program_hours(
    hours_id INT UNSIGNED NOT NULL,
    program_id INT UNSIGNED NOT NULL,
    PRIMARY KEY(hours_id,program_id)) ENGINE INNODB;
    
CREATE TABLE hours(
    id INT UNSIGNED NOT NULL PRIMARY KEY,
    hours VARCHAR(10) NOT NULL) ENGINE INNODB;
 */
?>