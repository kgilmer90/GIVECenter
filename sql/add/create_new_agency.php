<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once(dirname(__FILE__).'/../../php/MySQLDatabase/MySQLDatabaseConn.php');

function create_new_agency($conn,$info_array)
{
    $addr_id = create_new_addr($conn, $info_array['addr']);
    $p_id = create_new_p_contact($conn, $info_array['p_contact']);
        
    $query = "INSERT INTO (name,descript,p_contact_id,addr,mail,phone,fax)
                VALUES (".$info_array['name'].",".$info_array['descript'].",
                $p_id,$addr_id,".$info_array['mail'].",".$info_array['phone'].",".$info_array['fax'].")";
    
    try{
        $conn->query($query);
    }
    catch(Exception $e){
        echo $e;
    }
    
    $query2 = "SELECT id FROM agency SORT id DESC Limit 1,1";
    
    try{
        $conn->query($query2);
    }
    catch(Exception $e){
        echo $e;
    }
    $agency_id = $conn->fetchRowAsAssoc();
    // get id of last program inserted
    
    echo $query."<br/>".$query2."<br/>";
    return $agency_id['id'];
}
?>
