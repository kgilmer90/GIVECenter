<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * remove s contact and set program's to null
 */

function remove_s_contact_latest($conn,$p_id){
    // Find latest S Contact and history for matching program and remove
    // find contact
    $query1 = "SELECT *
        FROM contact_history
        WHERE program_id = $p_id
        ORDER BY id
        LIMIT 0,1";
    try{
        $conn->query($query1);
    }
    catch(Exception $e){
        echo $e;
    }
    $contact = $conn->getRowAsAssoc();
    // delete specific contact
    $query2 = "DELETE FROM student_contact
            WHERE id = ".$contact['contact_id'];
    try{
        $conn->query($query2);
    }
    catch(Exception $e){
        echo $e;
    }
    // remove from history
    $query3 = "DELETE FROM contact_history
        WHERE id = ".$contact['id'];
    try{
        $conn->query($query3);
    }
    catch(Exception $e){
        echo $e;
    }
    
    // remove pointer from program
    $query4 = "UPDATE program
        SET s_contact = 'null'
        WHERE id = $p_id";
    
    try{
        $conn->query($query4);
    }
    catch(Exception $e){
        echo $e;
    }
}

// to remove specific contact
function remove_s_contact_by_id($conn,$s_id){
    $query1 = "DELETE FROM student_contact
        WHERE id = $s_id";
    try{
        $conn->query($query1);
    }
    catch(Exception $e){
        echo $e;
    }
    $query2 = "DELETE FROM contact_history
        WHERE contact_id = $s_id";
    try{
        $conn->query($query2);
    }
    catch(Exception $e){
        echo $e;
    }
}

/*
CREATE TABLE student_contact(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
    l_name VARCHAR(20),
    f_name VARCHAR(20),
    m_name VARCHAR(20),
    suf CHAR(3),
    m_phone CHAR(10),
    w_phone CHAR(10),
    mail VARCHAR(40)) ENGINE INNODB;
    
CREATE TABLE contact_history(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
    contact_id INT,
    program_id INT) ENGINE INNODB;
*/
?>
