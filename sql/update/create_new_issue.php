<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * import issues from array and match?
 */



include_once(dirname(__FILE__).'/../../php/MySQLDatabase/MySQLDatabaseConn.php');

function create_new_issue_assoc($conn,$program_id,$issue_id)
{
    foreach ($issue_id as $temp)
    {
        $query = "INSERT INTO program_issues(program_id,issue_id)
                    VALUES($program_id,$temp)";
        $conn->query($query);
    }
    // get id of last program_issue inserted
    
    return 0;
}
?>
