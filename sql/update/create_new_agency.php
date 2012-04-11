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
    
    $conn->query($query);
    
     $agency_id = "SELECT id FROM agency SORT id DESC Limit 1,1";
    // get id of last program inserted
    
    return $agency_id;
}
?>
