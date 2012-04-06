<?php
/*
 *  Create_Issues.php
 * ***********************************************************************  *
 * 
 * ***********************************************************************  *
 */

include_once('../../php/GIVE/GIVEAddr.php');
 
/**
 *  Returns Issue strings in array for specific program 
 * @param MySQLDatabaseConn $conn   database connection object
 * @param int $program_id   id for program to find issues for
 * @return array      Array containing all the issue objects
 */
function create_issues($conn,$program_id)
{
    $query = "SELECT issues.name
                FROM issues,program_issues
                WHERE program_issues.program_id=$program_id
                AND program_issues.issue_id=issues.id";
    $conn->query($query);

    $results = $conn->fetchAllAsNumeric();

    return $results;
}
?>