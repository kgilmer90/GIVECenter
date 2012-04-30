<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * import issues from array and match?
 */



include_once(dirname(__FILE__).'/../../php/MySQLDatabase/MySQLDatabaseConn.php');

/**
 *  Function to create program_issues for seleted program
 * @param type $conn    database connection
 * @param type $program_id  Id of program to add issues for
 * @param type $issue_id    Array of Id's for Issues to associate with program
 * @return int Nothing to return
 */
function create_new_issue($conn,$program_id,$issue_id)
{
    foreach ($issue_id as $temp)
    {
        $query = "INSERT INTO program_issues(program_id,issue_id)
                    VALUES($program_id,$temp)";
        try{
            $conn->query($query);
        }
        catch(Exception $e){
            echo $e;
        }
    }
    // get id of last program_issue inserted
    
    return 0;
}
?>
