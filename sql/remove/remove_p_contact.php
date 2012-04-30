<?php

/*
 * 
 * remove p contact and set null in program/agency
 */

function remove_p_contact_program($conn,$program_id){
    // find contact matching program
    $query1 = "SELECT p_contact
        FROM program
        WHERE id = $program_id";
    try{
        $conn->query($query1);
    }
    catch(Exception $e){
        echo $e;
    }
    
    $contact_id = $conn->fetchRowAsAssoc();
    $contact_id = $contact_id['p_contact'];
    
    // remove pro contact
    $query2 = "DELETE FROM pro_contact
        WHERE id = $contact_id";
    try{
        $conn->query($query2);
    }
    catch(Exception $e){
        echo $e;
    }
    // remove pointer
    $query3 = "UPDATE program
        SET p_contact = 'null'
        WHERE id = $program_id";
    try{
        $conn->query($query3);
    }
    catch(Exception $e){
        echo $e;
    }
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
