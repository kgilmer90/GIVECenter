<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once('../../php/GIVE/GIVEContactHistory.php');
include_once('../../php/MySQLDatabase/MySQLDatabaseConn.php');

function create_contact_history($conn, $program_id)
{
    $history_array = array();
    $query = "SELECT *.student_contact
                FROM student_contact,contact_history
                WHERE contact_history.program_id = $program_id
                AND contact_history.contact_id = student_contact.id";
    $conn->query($query);
    
    $results = $conn->fetchAllAsAssoc();
    
    foreach($results as $temp)
    {
        $contact = new GIVEContactHistory($temp);
        array_push($history_array,$contact);
    }
    
    return $history_array;
}


?>
