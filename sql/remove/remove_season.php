<?php

/*
 * Remove seasons matching program id
 */

function remove_season($conn,$program_id)
{
    $query="DELETE FROM program_seasons
            WHERE program_id = $program_id";
    try{
        $conn->query($query);
    }
    catch(Exception $e){
        echo $e;
    }
}

/*CREATE TABLE program_seasons(
    program_id INT UNSIGNED,
    season_id INT UNSIGNED,
    PRIMARY KEY(program_id,season_id)) ENGINE INNODB;*/
?>
