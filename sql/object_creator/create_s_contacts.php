<?php
/*
 * Create_S_Contacts.php
 * 
 * *******************************************************************  *
 * Functions for creating objects for STUDENT contact information       *
 *                                                                      *
 * create_s_contact($conn,$id)                                          *
 * create_s_contact_limited($conn,$id)                                  *
 * create_all_s_contacts($conn)                                         *
 * create_all_s_contacts_limited($conn)                                 *
 * *******************************************************************  *
 */
 
include_once('../../php/GIVE/GIVEStudentContact.php');
include_once('../../php/MySQLDatabase/MySQLDatabaseConn.php');

/**
 *  Creates all student contact objects
 * @param $conn database connection object
 * @param $id   which contact information to create an object for
 * @return      object containing specified contacts information
 */
function create_s_contact($conn,$id)
{
    $query = "SELECT id,l_name,f_name,m_name,suf,w_phone,m_phone,mail
                FROM student_contact
                WHERE id=$id";
    $conn->query($query);

    $results = $conn->fetchRowAsAssoc();

    $s = new GIVEAgency($results);
    
    return $s;
}

/**
 * LIMITED VERSION Creates student contact object
 * @param $conn database connection object
 * @param $id   which contact information to create an object for
 * @return      object containing specified contacts information
 */
function create_s_contacts_limited($conn,$id)
{
    $query = "SELECT id,l_name,f_name,m_name,suf,w_phone,mail
                FROM student_contact
                WHERE id=$id";
    
    $conn->query($query);

    $results = $conn->fetchRowAsAssoc();

    $s = new GIVEAgency($results);
    
    return $s;
}

/**
 *  Creates all student contact objects
 * @param $conn database connection object
 * @return returns array holding objects
 */
function create_all_s_contacts($conn)
{
    $s_array = array();

    $query = "SELECT id,l_name,f_name,m_name,suf,w_phone,m_phone,mail
                FROM student_contact";
    
    $conn->query($query);

    $results = $conn->fetchAllAsAssoc();

    foreach($results as $temp)
    {
        $p = new GIVEAgency($temp);
        array_push($s_array,$p);
    }

    return $s_array;
}

/**
 * LIMITED VERSION Creates all student contact objects
 * @param $conn database connection object
 * @return returns array holding objects
 */
function create_all_s_contacts_limited($conn)
{
    $s_array = array();

    $query = "SELECT id,l_name,f_name,m_name,suf,w_phone,mail
                FROM student_contact";
    
    $conn->query($query);

    $results = $conn->fetchAllAsAssoc();

    foreach($results as $temp)
    {
        $p = new GIVEAgency($temp);
        array_push($s_array,$p);
    }

    return $s_array;
}
?>