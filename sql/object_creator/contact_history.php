<?php
/**
 * Find history either pro or stu contacts for a program
 * @param <program_id>  which program to find the history for
 * @param <type> use either s or p, for student or pro
 * @return array of names for contacts?
 */

include_once('../setup/search_queries.php');
include_once('../../php/GIVE/GIVEAddr.php');
include_once('../../php/MYSQLDatabase/MySQLDatabaseConn.php');
 
 function contact_history($program_id,$type)
{
    $contact_array = array();
    
    return $contact_array;
}
?>