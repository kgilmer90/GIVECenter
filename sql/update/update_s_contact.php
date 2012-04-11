<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * TODO: UPDATE S Contact Function
 */

function update_s_contact($conn,$program_id,$new_s_contact)
{

    
    
}
?>

CREATE TABLE student_contact(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
    l_name VARCHAR(20),
    f_name VARCHAR(20),
    m_name VARCHAR(20),
    suf CHAR(3),
    m_phone CHAR(10),
    w_phone CHAR(10),
    mail VARCHAR(40)) ENGINE INNODB;