<?php
/*
 * Create_P_Contacts.php
 * 
 * *******************************************************************  *
 * Functions for creating objects for professional contact information  *
 *                                                                      *
 * create_p_contact($conn,$id)                                         *
 * create_p_contact_limited($conn,$id)                                 *
 * create_all_p_contacts($conn)                                         *
 * create_all_p_contacts_limited($conn)                                 *
 * *******************************************************************  *
 */


include_once('../../php/GIVE/GIVEAddr.php');

/**
 * Creates pro contact object, and returns object
 * @param $conn     database connection object
 * @param $id       program or agency to return data for
 * @return $contact p_contact info object
 */ 
function create_p_contact($conn,$id)
{
    $query = "SELECT id,title,l_name,f_name,m_name,suf,w_phone,m_phone,mail
                FROM pro_contact
                WHERE id=$id";

    $conn->query($query);

    $results = $conn->fetchRowAsAssoc();
    
    $p = new GIVEAgency($results);

    return $p;
}

/**
 * LIMITED VERSION Creates pro contact object, and returns object
 * @param $conn     database connection object
 * @param $id       program or agency to return data for
 * @return $contact p_contact info object
 */ 
function create_p_contact_limited($conn,$id)
{
    $query = "SELECT id,title,l_name,f_name,m_name,suf,w_phone,mail
                FROM pro_contact
                WHERE id=$id";

    $conn->query($query);

    $results = $conn->fetchRowAsAssoc();
    
    $p = new GIVEAgency($results);

    return $p;
}

/**
 * Creates pro contact objects, and returns array holding all of them
 * @param $conn     database connection object
 * @return array holding contact objects
 */
function create_all_p_contacts($conn)
{
    $p_array = array();

    $query = "SELECT id,title,l_name,f_name,m_name,suf,w_phone,m_phone,mail
                FROM pro_contact";

    $conn->query($query);

    $results = $conn->fetchAllAsAssoc();

    foreach($results as $temp)
    {
        $p = new GIVEAgency($temp);
        array_push($p_array,$p);
    }

    return $p_array;
}

/**
 * LIMITED VERSION Creates pro contact objects, and returns array holding all of them
 * @param $conn     database connection object
 * @return array holding contact objects
 */
function create_all_p_contacts_limited($conn)
{
    $p_array = array();

    $query = "SELECT id,title,l_name,f_name,m_name,suf,w_phone,mail
                FROM pro_contact";

    $conn->query($query);

    $results = $conn->fetchAllAsAssoc();

    foreach($results as $temp)
    {
        $p = new GIVEAgency($temp);
        array_push($p_array,$p);
    }

    return $p_array;
}
?>