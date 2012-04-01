<?php
/**
 *  Creates all student contact objects
 * @return returns array holding objects
 */
 
 include_once('../setup/search_queries.php');
include_once('../../php/GIVE/GIVEAddr.php');
include_once('../../php/MYSQLDatabase/MySQLDatabaseConn.php');

function create_s_contacts()
{
    $conn = new MySQLDatabaseConn('localhost','give_ctr_agencies','root', 'mypass');
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