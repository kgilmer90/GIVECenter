<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once(dirname(__FILE__).'/../../php/MySQLDatabase/MySQLDatabaseConn.php');

function create_new_s_contact($conn,$info_array)
{
    //  Create Student Contact
    $query1 = "INSERT INTO student_contact(l_name,f_name,m_name,suf,m_phone,w_phone,mail)
                VALUES ('".$info_array['l_name']."','".$info_array['f_name']."','".$info_array['m_name']."','".$info_array['suf']."',".$info_array['m_phone'].",".$info_array['w_phone'].",'".$info_array['mail']."')";
    try{
        $conn->query($query1,$conn);
    }
    catch(Exception $e){
        echo $e;
    }
    
    //  Get id of last contact created
    $query2 = "SELECT id
        FROM student_contact
        ORDER BY id DESC
        Limit 0,1";
    try{
        $conn->query($query2,$conn);
    }
    catch(Exception $e){
        echo $e;
    }
    $contact_id = $conn->fetchRowAsAssoc();
      
    // return id of last contact inserted
    return $contact_id['id'];
}

function create_new_contact_history($conn, $p_id,$s_id){
        //  Update Contact History Table to include the Latest Entry
    
    $query3 = "INSERT INTO contact_history(contact_id,program_id)
        VALUES (".$s_id.",$p_id)";
    try{
        $conn->query($query3,$conn);
    }
    catch(Exception $e){
        echo $e;
    }
}
?>
