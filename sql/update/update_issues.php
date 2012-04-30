<?php

/*
 * Remove all the old issues, then pass the new ones to the create new issues function
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