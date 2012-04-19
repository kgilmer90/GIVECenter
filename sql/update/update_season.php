<?php

/*
 * Remove Old Seasons, then call create new function
 * 
 */

function update_season($conn,$program_id,$new_seasons)
{
    $query="DELETE FROM program_seasons
            WHERE program_id = $program_id";
    $conn->query($query);
    
    create_new_seasons($conn, $program_id, $new_seasons);
}


?>
