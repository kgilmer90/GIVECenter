<?php

/*
 * Create new Program for existing agency, or for a new one
 * 
 */

include_once('../../php/MySQLDatabase/MySQLDatabaseConn.php');

function create_new_program_existing_agency($conn,$info_array)
{
    $addr_id = create_new_addr($conn, $info_array['addr']);
    $p_id = create_new_p_contact($conn, $info_array['p_contact']);
    $s_id = create_new_s_contact($conn, $info_array['s_contact']); 
    
    $query = "INSERT INTO programs(referal,season,time,name,duration,notes,addr,agency,p_contact,s_contact,descript)
                VALUES( ".$info_array['referal'].",".$info_array['season'].",".$info_array['time'].",".$info_array['name'].",
                ".$info_array['duration'].",".$info_array['notes'].",$addr_id,".$info_array['agency'].",
                $p_id,$s_id,".$info_array['descript'].")";
    
    $conn->query($query);
    $program_id = "SELECT id
                    FROM programs
                    SORT id DESC
                    Limit 1,1";
    // get id of last program inserted
    
    create_new_issue_assoc($conn, $program_id, $info_array['issues']);
    
    return $program_id;
}


function create_new_program_new_agency($conn,$info_array)
{
    $addr_id = create_new_addr($conn, $info_array['addr']);
    $issues_id = create_new_issue($conn, $info_array['issues']);
    $p_id = create_new_p_contact($conn, $info_array['p_contact']);
    $s_id = create_new_s_contact($conn, $info_array['s_contact']); 
    $agency_id = create_new_agency($conn,$info_array['agency']);
    
    $query = "INSERT INTO programs(referal,season,time,name,duration,notes,issues,addr,agency,p_contact,s_contact,descript)
                VALUES( ".$info_array['referal'].",".$info_array['season'].",".$info_array['time'].",".$info_array['name'].",
                ".$info_array['duration'].",".$info_array['notes'].",$issues_id,$addr_id,$agency_id,
                $p_id,$s_id,".$info_array['descript'].")";

    $conn->query($query);
    // get id of last program inserted
    
    $program_id = "SELECT id
                    FROM programs
                    SORT id DESC
                    Limit 1,1";
    
    create_new_issue_assoc($conn, $program_id, $issues_id);
    
    // get id of last program inserted
    
    return $program_id;
}
?>
