<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * remove p contact and set null in program/agency
 */

function remove_p_contact($conn,$p_id){
    
    $query1 = "SELECT p_contact
        FROM program
        WHERE id = $p_id";
    
    $query2 = "DELETE FROM pro_contact
        WHERE id = $p_id";
    
    $query3 = "UPDATE program
        SET p_contact = 'null'
        WHERE id = $p_id";
    
    $p_id = $conn->query($query1);
    $conn->query($query2);
    $conn->query($query3);
}

/*CREATE TABLE pro_contact(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
    title VARCHAR(30),
    l_name VARCHAR(30),
    f_name VARCHAR(30),
    m_name VARCHAR(30),
    suf VARCHAR(3),
    m_phone CHAR(10),
    w_phone CHAR(10),
    mail VARCHAR(40)) ENGINE INNODB;
 * CREATE TABLE program(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    agency INT UNSIGNED NOT NULL,
    addr INT,
    name VARCHAR(20),
    p_contact INT UNSIGNED NOT NULL,
    s_contact INT UNSIGNED NOT NULL,
    descript VARCHAR(400),
    referal BOOL,
    notes VARCHAR(400),
    duration VARCHAR(50)) ENGINE INNODB;
 */
?>
