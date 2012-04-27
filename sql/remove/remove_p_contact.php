<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * remove p contact and set null in program/agency
 */

function remove_p_contact_program($conn,$program_id){
    
    $query1 = "SELECT p_contact
        FROM program
        WHERE id = $program_id";
    $conn->query($query1);
    $contact_id = $conn->fetchRowAsAssoc();
    $contact_id = $contact_id['p_contact'];
    
    $query2 = "DELETE FROM pro_contact
        WHERE id = $contact_id";
    $conn->query($query2);
    
    $query3 = "UPDATE program
        SET p_contact = 'null'
        WHERE id = $program_id";
    $conn->query($query3);
}

function remove_p_contact_agency($conn,$agency_id){
    
    $query1 = "SELECT p_contact
        FROM agency
        WHERE id = $agency_id";
    $conn->query($query1);
    $contact_id = $conn->fetchRowAsAssoc();
    $contact_id = $contact_id['p_contact'];
    
    $query2 = "DELETE FROM pro_contact
        WHERE id = $contact_id";
    $conn->query($query2);
    
    $query3 = "UPDATE agency
        SET p_contact = 'null'
        WHERE id = $agency_id";
    $conn->query($query3);
}
?>
