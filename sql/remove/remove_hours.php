<?php


/**
 *  Delete Hours from Program
 * @param type $conn
 * @param type $program_id 
 */

function remove_hours($conn,$program_id)
{
    $query1="DELETE FROM program_hours
            WHERE program_id = $program_id";
    try{
        $conn->query($query1);
    }
    catch(Exception $e){
        echo $e;
    }
}

/*CREATE TABLE program_hours(
    hours_id INT UNSIGNED NOT NULL,
    program_id INT UNSIGNED NOT NULL,
    PRIMARY KEY(hours_id,program_id)) ENGINE INNODB;*/
?>
