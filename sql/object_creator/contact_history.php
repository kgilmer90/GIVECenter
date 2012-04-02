<?php
/*
 * Find history either pro or stu contacts for a program
 * 
 */

include_once('../../php/GIVE/GIVEAddr.php');

/**
 *
 * @param type $conn        connection variable
 * @param type $program_id  if of program to fetch contact history
 * @param type $type        pro contact or student? use p or s
 * @return array            array containing information objects for contacts
 */

 function contact_history($conn, $program_id,$type)
{
    $contact_array = array();
    
    $query = $program_id.$type;
    $conn->query($query);
    
    return $contact_array;
}
?>