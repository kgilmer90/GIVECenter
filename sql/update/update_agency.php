<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * TODO: Update Agency Function
 */


?>
CREATE TABLE agency(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20),
    descript VARCHAR(1000),
    p_contact_id INT UNSIGNED, 
    addr INT UNSIGNED,
    mail VARCHAR(40),
    phone CHAR(10),
    fax CHAR(10)) ENGINE INNODB;