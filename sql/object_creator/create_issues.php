<?php
/*
 *  Create_Issues.php
 * ***********************************************************************  *
 * 
 * ***********************************************************************  *
 */

include_once(dirname(__FILE__).'/../../php/GIVE/GIVEAddr.php');
include_once(dirname(__FILE__).'/../../php/MySQLDatabase/MySQLDatabaseConn.php');
 
/**
 *  Returns Issue strings in array for specific program 
 * @param MySQLDatabaseConn $conn   database connection object
 * @param int $program_id   id for program to find issues for
 * @return array      Array containing all the issue objects
 */
function create_issues($conn,$program_id)
{
    $query = "SELECT name.issues
                FROM issues,program_issues
                WHERE program_issues.program_id=$program_id
                AND program_issues.issue_id=issues.id";
    $conn->query($query);

    $results = $conn->fetchAllAsNumeric();
    
    if($conn->numRows()==0){
        return null;
    }

    return $results;
}

/**
 *  Returns All issues in a Numerical Sock Array For Displaying Choices
 * @param type $conn
 * @return $results     Issues numerical sock array
 */
function create_all_issues($conn)
{
    $query = "SELECT *issues
                FROM issues";
    
    $conn->query($query);

    $results = $conn->fetchAllAsAssoc();
    
    if($conn->numRows()==0){
        return null;
    }
    
    return $results;
}
?>