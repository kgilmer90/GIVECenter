<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once(dirname(__FILE__).'/../../php/MySQLDatabase/MySQLDatabaseConn.php');

function create_new_s_contact($conn,$info_array,$program_id)
{
    //  Create Student Contact
    $query1 = "INSERT INTO student_contact(l_name,f_name,m_name,sug,m_phone,w_phone,mail)
                VALUES (".$info_array['l_name'].",".$info_array['f_name'].",".$info_array['m_name'].",".$info_array['suf'].",".$info_array['m_phone'].",".$info_array['w_phone'].",".$info_array['mail'].")";
    try{
        $conn->query($query1);
    }
    catch(Exception $e){
        echo $e;
    }
    
    //  Get id of last contact created
    $query2 = "SELECT id
        FROM student_contacts
        SORT id DESC
        Limit 1,1";
    try{
        $conn->query($query2);
    }
    catch(Exception $e){
        echo $e;
    }
    $contact_id = $conn->fetchRowAsAssoc();
       
    //  Update Contact History Table to include the Latest Entry
    $query3 = "INSERT INTO contact_history(contact_id,program_id)
        VALUES (".$contact_id['contact_id'].",$program_id)";
    try{
        $conn->query($query3);
    }
    catch(Exception $e){
        echo $e;
    }
    echo $query1."<br/>".$query2."<br/>".$query3."<br/>";
    
    
    // return id of last contact inserted
    return $contact_id;
}
/*CREATE TABLE contact_history(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
    contact_id INT,
    program_id INT) ENGINE INNODB;*/
?>
