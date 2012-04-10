<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * import issues from array and match?
 */



include_once('../../php/MySQLDatabase/MySQLDatabaseConn.php');

function create_new_issue($conn,$info_array)
{
    $query = "";
    
    $conn->query($query);
    
    //query issues
    
        $issue_id = "SELECT id
        FROM issues
        SORT id DESC
        Limit 1,1";
    // get id of last program_issue inserted
    //  TODO: Allow to handle multiple issues?
    
    return $issue_id;
}

function create_new_issue_assoc($conn,$program_id,$issue_id)
{
    $query = "INSERT INTO program_issues(program_id,issue_id)
        VALUES($program_id,$issue_id)";
    
    $conn->query($query);
    $program_issue_id = "SELECT id
        FROM program_issue
        SORT id DESC
        Limit 1,1";
    // get id of last program_issue inserted
    
    return $program_issue_id;
}
?>
