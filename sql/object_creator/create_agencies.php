<?php
/**
 * Creates Array Objects
 * @return agency object
 *
 */

include_once('../setup/search_queries.php');
include_once('../../php/GIVE/GIVEAddr.php');
include_once('../../php/MYSQLDatabase/MySQLDatabaseConn.php');
 
 
function create_agencies()
{
    $conn = new MySQLDatabaseConn('localhost','give_ctr_agencies','root', 'mypass');
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