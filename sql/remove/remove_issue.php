<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function update_issues($conn,$program_id)
{
    $query="DELETE FROM program_issues
            WHERE program_id = $program_id";
    $conn->query($query);
}

/*CREATE TABLE program_issues(
    program_id INT UNSIGNED NOT NULL,
    issue_id INT UNSIGNED NOT NULL,
    PRIMARY KEY(program_id,issue_id)) ENGINE INNODB;*/

?>
