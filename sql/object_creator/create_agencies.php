<?php
/*
 * Creates Array Objects
 *
 */

include_once('../../php/GIVE/GIVEAddr.php');
 
/**
 *  Creates Objects for all the agencies and their information and returns them
 *  in an array
 * @param MySQLDatabaseConn $conn
 * @return array 
 */
function create_agencies($conn)
{
    $agency_array = array();

    $query = "SELECT id,name,descript,mail,phone,fax,p_contact,addr
                FROM agency";
  
    $conn->query($query);

    $results = $conn->fetchAllAsAssoc();

    foreach($results as $temp)
    {
        $agency = new GIVEAgency($temp);
        array_push($agency_array,$agency);
    }
    		
    return $agency_array;
}
?>