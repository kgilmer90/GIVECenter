<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


include_once(dirname(__FILE__).'/../../php/MySQLDatabase/MySQLDatabaseConn.php');

/**
 *  Function for creating new address for either a program or agency and inserting into the db
 * @param type $conn
 * @param type $info_array Nested Sock Array of addr, Should be $info_array['addr']
 * @return string $addr_id of the address inserted
 */
function create_new_addr($conn,$info_array)
{
    $query = "INSERT INTO addr(street,city,state_us,zip)
        VALUES ('".$info_array['street']."','".$info_array['city']."','".$info_array['state_us']."','".$info_array["zip"]."')";
    
    try{
        $conn->query($query);
    }
    catch(Exception $e){
        echo $e;
    }
    
    $addr_id = "SELECT id
    FROM addr
    ORDER BY id DESC
    Limit 0,1";
    // get id of last program_issue inserted
    try{
        $conn->query($addr_id);
    }
    catch(Exception $e){
        echo $e;
    }
    
    $addr_id = $conn->fetchRowAsAssoc();
    
    return $addr_id['id'];
}
?>
