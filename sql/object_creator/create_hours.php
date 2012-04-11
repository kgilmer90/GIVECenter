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
    $query = "SELECT hours
        FROM hours
        WHERE program_id = $program_id";
    $conn->query($query);
    
    if($conn->numRows()==0){
        return null;
    }
    $results = $conn->fetchAllAsNumeric();
    
    return $results;    
}
?>