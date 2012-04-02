<?php
/**
 *  Creates all student contact objects
 * @param $conn database connection object
 * @return returns array holding objects
 */
 
include_once('../../php/GIVE/GIVEAddr.php');

function create_s_contacts($conn)
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
?>