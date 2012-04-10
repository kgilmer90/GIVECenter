<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('../../php/MySQLDatabase/MySQLDatabaseConn.php');

function create_new_s_contact($conn,$info_array)
{
    $query = "INSERT INTO student_contact(l_name,f_name,m_name,sug,m_phone,w_phone,mail)
                VALUES ($info_array[l_name],$info_array[f_name],$info_array[m_name],$info_array[suf],$info_array[m_phone],$info_array[w_phone],$info_array[mail])";
    $conn->query($query);
    
    $s_id = "SELECT id
                    FROM student_contacts
                    SORT id DESC
                    Limit 1,1";
    // get id of last program inserted
    
    return $s_id;
    
    // TODO: Make to work with contact_history table
}
?>
