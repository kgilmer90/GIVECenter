<?php
/*
 * Contact_History.php
 * 
 * ************************************************************************ *
 * Find history for student contacts for a program                          *
 * Allows for all or limited information                                    *
 *                                                                          *
 * contact_history_s($conn,$id)                                             *
 * contact_history_s_limited($conn,$id)                                     *
 * ************************************************************************ *
 */

include_once('../../php/GIVE/GIVEStudentContact.php');
include_once('../../php/MySQLDatabase/MySQLDatabaseConn.php');

/**
 *  Creates array of objects containing all student contacts for a specified
 * program
 * @param $conn database connection object
 * @param $id program id for which to find history of student contacts
 * @return returns array of student contact objects
 */

function contact_history_s($conn,$id)
{
    $s_array = array();

    $query = "SELECT id,l_name,f_name,m_name,suf,w_phone,m_phone,mail
                FROM student_contact
                WHERE contact_history.contact_id = student_contact.id
                AND contact_history.program_id = $id";
    $conn->query($query);

    $results = $conn->fetchAllAsAssoc();

    foreach($results as $temp)
    {
        $s = new GIVEAgency($temp);
        array_push($s_array,$s);
    }

    return $s_array;
}

/**
 * LIMITED VERSION Creates all student contact objects
 * @param $conn database connection object
 * @param $id program id for which to find history of student contacts
 * @return returns array of student contact objects
 */
function contact_history_s_limited($conn,$id)
{
    $s_array = array();

    $query = "SELECT id,l_name,f_name,m_name,suf,w_phone,mail
                FROM student_contact
                WHERE contact_history.contact_id = student_contact.id
                AND contact_history.program_id = $id";
    $conn->query($query);

    $results = $conn->fetchAllAsAssoc();

    foreach($results as $temp)
    {
        $s = new GIVEAgency($temp);
        array_push($s_array,$s);
    }

    return $s_array;
}


?>