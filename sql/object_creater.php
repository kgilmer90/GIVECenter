<?php
/*
 * object_creater.php
 */

include('setup/search_queries.php');
include('../php/GIVE/GIVEAddr.php');
include('../php/MYSQLDatabase/MySQLDatabaseConn.php');



function create_addr($agency_id){
    $conn = new MySQLDatabaseConn('localhost','give_ctr_agencies','root', 'mypass');
    $addr_array;

    $query = "SELECT id,street,city,state,zip
                FROM addr";
  
    $conn->query($query);

    $results = $conn->fetchAllAsAssoc();

    foreach($results as $temp)
    {
        $addr = new GIVEAddr($temp);
        array_push($addr_array, $addr);
    }

    return $addr_array;
}

function create_agency($agency_id)
{
    $conn = new MySQLDatabaseConn('localhost','give_ctr_agencies','root', 'mypass');
    $agency_array;

    $query = "";
  
    $conn->query($query);

    $results = $conn->fetchAllAsAssoc();

    foreach($results as $temp)
    {
        $agency = new GIVEAgency($temp);
        array_push($agency_array, $agency);
    }

    return $agency_array;
}

function create_p_contact()
{}

function create_program($agency_id)
{}

function create_s_contact()
{}

function create_issues()
{}



?>