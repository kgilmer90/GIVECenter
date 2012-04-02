<?php
/*
 *  Do we want this?
 */

include_once('../../php/GIVE/GIVEAddr.php');
 
/**
 *  Returns Issue Objects in array 
 * @param MySQLDatabaseConn $conn   database connection object
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
        $issue = new GIVEAgency($temp);
        array_push($issue_array,$issue);
    }

    return $issue_array;
}
?>