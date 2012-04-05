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
function create_issues($conn)
{
    $issue_array = array();

    $query = "";

    $conn->query($query);

    $results = $conn->fetchAllAsAssoc();

    foreach($results as $temp)
    {
//        FIXME Create string array
        array_push($issue_array,$issue);
    }

    return $issue_array;
}
?>