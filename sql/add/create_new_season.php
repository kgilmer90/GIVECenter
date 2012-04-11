<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *  Inserts Seasons for a Program into database
 * @param type $conn    database connection
 * @param type $program_id  program to add seasons for
 * @param type $seasons_id  array holding season id's to add
 */
function create_new_seasons($conn,$program_id,$seasons_id)
{
    foreach($seasons_id as $temp)
    {
        $query = "INSERT INTO program_seasons(program_id,season_id)
            VALUES ($program_id,$temp)";
        $conn->query($query);
    }
}
?>  