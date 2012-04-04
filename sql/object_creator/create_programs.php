<?php
/*
 * Create_Programs.php
 * 
 * ************************************************************************ *
 * Functions for creating array objects for either ALL agencies or just     *
 * a specific one                                                           *
 *                                                                          *
 * create_programs($conn,$agency_id)                                        *
 * create_all_programs($conn)                                               *
 * ************************************************************************ *
 */


/**
 *  Creates all program objects for specific agency
 * @param $conn database connection object
 * @param $agency_id specific agency to find programs for
 * @return returns array holding objects
 */
 
//  Todo: Add funcionality for specific and all

include_once('../../php/GIVE/GIVEAddr.php');
 
function create_programs($conn,$agency_id)
{
    $program_array = array();

    $query = "SELECT id,referal,season,time,name,duration,notes,issues,addr,agency,p_contact,s_contact,descript
                FROM program
                WHERE agency=$agency_id";

    $conn->query($query);

    $results = $conn->fetchAllAsAssoc();

    foreach($results as $temp)
    {
        //  ADDR Object
        //  S Contact Objects
        //  Issues Object
        
        $program = new GIVEAgency($temp);
        array_push($program_array,$program);
    }

    return $program_array;
}


/**
 *  Creates all program objects for everyone
 * @param $conn database connection object
 * @return returns array holding objects
 */
function create_all_programs($conn)
{
    $program_array = array();

    $query = "SELECT id,referal,season,time,name,duration,notes,issues,addr,agency,p_contact,s_contact,descript
                FROM program";

    $conn->query($query);

    $results = $conn->fetchAllAsAssoc();

    foreach($results as $temp)
    {
        //  ADDR Object
        $temp['addr'] = create_addr($conn, $temp[$id]);
        //  S Contact Objects
        $temp['s_contact']=  create_s_contact($conn, $temp[$id]);
        //  P Contact Objects
        $temp['p_contact']=  create_p_contact($conn, $temp[$id]);
        //  Issues Object
        //  What to do here?
        
        //Create Program Object to Hold Everything
        $program = new GIVEAgency($temp);
        array_push($program_array,$program);
    }

    return $program_array;
}
?>