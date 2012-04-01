<?php
/**
 *  Do we want this?
 * @param program identifier for issues array?
 * @return return array of issues for the supplied program
 */
 
 include_once('../setup/search_queries.php');
include_once('../../php/GIVE/GIVEAddr.php');
include_once('../../php/MYSQLDatabase/MySQLDatabaseConn.php');
 
function create_issues($program_id)
{
    $conn = new MySQLDatabaseConn('localhost','give_ctr_agencies','root', 'mypass');
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