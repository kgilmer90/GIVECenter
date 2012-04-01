<?php
/*
 * object_creater.php
 */

include_once('../setup/search_queries.php');
include_once('../../php/GIVE/GIVEAddr.php');
include_once('../../php/MYSQLDatabase/MySQLDatabaseConn.php');

/**
 * Creates array of Address Objects created based on Agnecy ID supplied
 * @return Returns Array of Address Objects
 */

function create_addrs(){
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

/**
 * Creates Array Objects
 * @return agnecy object
 *
 */
function create_agencies()
{
    $conn = new MySQLDatabaseConn('localhost','give_ctr_agencies','root', 'mypass');
    $agency_array;

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

/**
 *Creates pro contact objects, and returns array holding all of them
 * @return array holding contact objects
 */
function create_p_contacts()
{
    $conn = new MySQLDatabaseConn('localhost','give_ctr_agencies','root', 'mypass');
    $p_array;

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
 *  Creates all program objects
 * @return returns array holding objects
 */
function create_programs()
{
    $conn = new MySQLDatabaseConn('localhost','give_ctr_agencies','root', 'mypass');
    $program_array;

    $query = "SELECT id,referal,season,time,name,duration,notes,issues,addr,agency,p_contact,s_contact,descript
                FROM program";

    // missing s_contact & descript in GIVEPROGRAM

    $conn->query($query);

    $results = $conn->fetchAllAsAssoc();

    foreach($results as $temp)
    {
        $program = new GIVEAgency($temp);
        array_push($program_array,$program);
    }

    return $program_array;
}

/**
 *  Creates all student contact objects
 * @return returns array holding objects
 */
function create_s_contacts()
{
    $conn = new MySQLDatabaseConn('localhost','give_ctr_agencies','root', 'mypass');
    $s_array;

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
 *  Do we want this?
 * @param program identifier for issues array?
 * @return return array of issues for the supplied program
 */
function create_issues($program_id)
{
    $conn = new MySQLDatabaseConn('localhost','give_ctr_agencies','root', 'mypass');
    $issue_array;

    $query = "";

    $conn->query($query);

    $results = $conn->fetchAllAsAssoc();

    foreach($results as $temp)
    {
        $issue = new GIVEAgency($temp);
        array_push($issue_array,$issue);
    }

    return $issue_array;
}

/**
 * Find history either pro or stu contacts for a program
 * @param <program_id>  which program to find the history for
 * @param <type> use either s or p, for student or pro
 * @return array of names for contacts?
 */
function contact_history($program_id,$type)
{
    
    return $contact_array;
}



?>