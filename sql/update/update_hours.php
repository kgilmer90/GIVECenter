<?php

/*
 * delete matches and create new ones
 * 
 */

function update_hours($conn,$program_id,$new_hours)
{
    $query="DELETE FROM hours
            WHERE program_id = $program_id";
    $conn->query($query);
    
    create_new_hours($conn, $program_id, $new_hours);
}
?>
CREATE TABLE hours(
    program_id INT UNSIGNED NOT NULL,
    hours INT NOT NULL,
    PRIMARY KEY(program_id,hours)) ENGINE INNODB;