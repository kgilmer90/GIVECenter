<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once(dirname(__FILE__).'/../../php/MySQLDatabase/MySQLDatabaseConn.php');

function create_new_p_contact($conn,$info_array)
{
    $query = "INSERT INTO pro_contact(l_name,f_name,m_name,sug,m_phone,w_phone,mail)
                VALUES ($info_array[title],$info_array[l_name],$info_array[f_name],$info_array[m_name],$info_array[suf],$info_array[m_phone],$info_array[w_phone],$info_array[mail]";
    
    $conn->query($query);
    
    $p_id = "SELECT id
                    FROM pro_contacts
                    SORT id DESC
                    Limit 1,1";
    // get id of last program inserted
    
    return $p_id;
}
?>
