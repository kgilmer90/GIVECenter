<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * remove s contact and set program's to null
 */

function remove_s_contact_latest($conn,$p_id){
    $query1 = "SELECT *
        FROM contact_history
        WHERE program_id = $p_id
        ORDER BY id
        LIMIT 0,1";
    
    $query2 = "DELETE FROM student_contact
            WHERE id = ".$contact['contact_id'];
    
    $query3 = "DELETE FROM contact_history
        WHERE id = ".$contact['id'];
    
    $conn->query($query1);
    $contact = $conn->getRowAsAssoc();
    $conn->query($query2);
    $conn->query($query3);
}

function remove_s_contact_by_id($conn,$s_id){
    $query1 = "DELETE FROM student_contact
        WHERE id = $s_id";
    $query2 = "DELETE FROM contact_history
        WHERE contact_id = $s_id";
    
    $conn->query($query1);
    $conn->query($query2);
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
