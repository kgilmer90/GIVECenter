<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function delete_season($conn,$program_id)
{
    $query="DELETE FROM program_seasons
            WHERE program_id = $program_id";
    $conn->query($query);
}

/*CREATE TABLE program_seasons(
    program_id INT UNSIGNED,
    season_id INT UNSIGNED,
    PRIMARY KEY(program_id,season_id)) ENGINE INNODB;*/
?>
