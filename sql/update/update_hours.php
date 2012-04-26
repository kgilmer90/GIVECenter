<?php

/*
 * delete matches and create new ones
 * 
 */

include_once(dirname(__FILE__).'/../add/create_new_hours.php');

function update_hours($conn,$program_id,$new_hours)
{
    $query="DELETE FROM program_hours
            WHERE program_id = $program_id";
    $conn->query($query);
    
    create_new_hours($conn, $program_id, $new_hours);
}
?>