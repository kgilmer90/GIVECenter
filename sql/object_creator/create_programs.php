<?php
/**
 *  Creates all program objects
 * @param $conn database connection object
 * @return returns array holding objects
 */
 
include_once('../../php/GIVE/GIVEAddr.php');
 
function create_programs($conn)
{
    $program_array = array();

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
?>