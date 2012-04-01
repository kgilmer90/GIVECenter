<?php
/**
 * Creates array of Address Objects created based on Agnecy ID supplied
 * @return Returns Array of Address Objects
 */
 
include_once('../setup/search_queries.php');
include_once('../../php/GIVE/GIVEAddr.php');
include_once('../../php/MYSQLDatabase/MySQLDatabaseConn.php');
 
function create_addrs(){
    $conn = new MySQLDatabaseConn('localhost','give_ctr_agencies','root', 'mypass');
    $addr_array = array();

    $query = "SELECT id,street,city,state,zip
                FROM addr";
  
    $conn->query($query);

    $results = $conn->fetchAllAsAssoc();

    foreach($results as $temp)
    {
        $addr = new GIVEAddr($temp);
        array_push($addr_array, $addr);
    }

    return $addr_array;
}
?>i