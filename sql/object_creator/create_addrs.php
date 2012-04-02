<?php
/*
 * Creates array of Address Objects created based on Agnecy ID supplied
 */
 
include_once('../../php/GIVE/GIVEAddr.php');

/**
 *  Creates and Returns array of Objects Holding Address information
 *  for passage into javascript
 * @param MySQLDatabaseConn $conn   connection to database
 * @return array    array of objects containing address information
 */ 
function create_addrs($conn){
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