<?php

/*
    find all issues matching program, and remove
 */

function remove_issues($conn,$program_id)
{
    $query="DELETE FROM program_issues
            WHERE program_id = $program_id";
    try{
        $conn->query($query);
    }
    catch(Exception $e){
        echo $e;
    }
}

/*CREATE TABLE program_issues(
    program_id INT UNSIGNED NOT NULL,
    issue_id INT UNSIGNED NOT NULL,
    PRIMARY KEY(program_id,issue_id)) ENGINE INNODB;*/

?>
