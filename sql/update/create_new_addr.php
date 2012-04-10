<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


include_once(dirname(__FILE__).'/../../php/MySQLDatabase/MySQLDatabaseConn.php');

function create_new_addr($conn,$info_array)
{
    $query = "INSERT INTO addr(street,city,state_us,zip)
        VALUES (".$info_array['street'].",".$info_array['city'].",".$info_array['state_us'].",".$info_array["zip"].")";
    
    $conn->query($query);
    
    $addr_id = "SELECT id
    FROM addr
    SORT id DESC
    Limit 1,1";
    // get id of last program_issue inserted
    
    return $addr_id;
}
?>
