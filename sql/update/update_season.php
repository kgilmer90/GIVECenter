<?php

/*
 * Remove Old Seasons, then call create new function
 * 
 */

include_once(dirname(__FILE__).'/../add/create_new_season.php');

function update_season($conn,$program_id,$new_seasons)
{
    $query="DELETE FROM program_seasons
            WHERE program_id = $program_id";
    $conn->query($query);
    
    create_new_seasons($conn, $program_id, $new_seasons);
}


?>
