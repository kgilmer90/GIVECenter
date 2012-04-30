<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once(dirname(__FILE__).'/../../php/MySQLDatabase/MySQLDatabaseConn.php');

function create_new_agency($conn,$info_array)
{
    $query = "INSERT INTO agency(name,descript,p_contact_id,addr,mail,phone,fax)
            VALUES ('".$info_array['name']."','".$info_array['descript']."',
            ".$info_array['p_contact'].",".$info_array['addr'].",'".$info_array['mail']."',
                ".$info_array['phone'].",".$info_array['fax'].")";
    
    try{
        $conn->query($query);
    }
    catch(Exception $e){
        echo $e;
    }
    
    $query2 = "SELECT id FROM agency ORDER BY id DESC Limit 1,1";
    
    try{
        $conn->query($query2);
    }
    catch(Exception $e){
        echo $e;
    }
    $agency_id = $conn->fetchRowAsAssoc();
    // get id of last program inserted
   
    return $agency_id['id'];
}
?>
