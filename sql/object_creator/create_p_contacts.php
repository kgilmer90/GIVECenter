<?php
/**
 *Creates pro contact objects, and returns array holding all of them
 * @param $conn     database connection object
 * @return array holding contact objects
 */

include_once('../../php/GIVE/GIVEAddr.php');
 
function create_p_contacts($conn)
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

function create_p_contacts_limited($conn)
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