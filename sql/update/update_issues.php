<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once(dirname(__FILE__).'/../add/create_new_issue.php');

function update_issues($conn,$program_id,$new_issues)
{
    $query="DELETE FROM program_issues
            WHERE program_id = $program_id";
    $conn->query($query);
    
    create_new_issue($conn, $program_id, $new_issues);
}
?>