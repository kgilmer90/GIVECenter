<?php
/*
 * Create_Addrs.php
 * 
 * ************************************************************************ *
 * Create object for address associated with specified ID or                *
 * Creates array of Address Objects created based on Agnecy ID supplied     *
 *                                                                          *
 * create_addr($conn,$id)                                                   *
 * create_all_addrs($conn)                                                  *
 * ************************************************************************ *
 */
 
include_once(dirname(__FILE__).'/../../php/GIVE/GIVEAddr.php');
include_once(dirname(__FILE__).'/../../php/MySQLDatabase/MySQLDatabaseConn.php');

/**
 *  Creates and Returns Single Object Holding Address information
 *  for passage into javascript
 * @param MySQLDatabaseConn $conn   connection to database
 * @param int $id   id for which address to pull
 * @return addr    object containing address information
 */ 
function create_addr($conn,$id){
    $query = "SELECT id,street,city,state,zip
                FROM addr
                WHERE id=$id";
  
    $conn->query($query);

    $results = $conn->fetchRowAsAssoc();

    $addr = new GIVEAddr($results);
    
    return $addr;
}

/**
 *  Creates and Returns array of Objects Holding Address information
 *  for passage into javascript
 * @param MySQLDatabaseConn $conn   connection to databases
 * @return array    array of objects containing address information
 */ 
function create_all_addrs($conn){
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