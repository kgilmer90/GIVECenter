<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *  Insert Hours for a Program into Database
 * @param type $conn    database connection
 * @param type $program_id  program for which to add hours entries
 * @param type $hours numeric array holding hours
 */
function create_new_hours($conn,$program_id,$hours)
{
    foreach($hours as $temp)
    {
        $query = "INSERT INTO program_hours (program_id,hours_id)
            VALUES ($program_id,$temp)";
        $conn->query($query);
    }
}
?>
