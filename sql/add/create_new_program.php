<?php

/*
 * Create new Program for existing agency, or for a new one
 * 
 */

include_once(dirname(__FILE__).'/../../php/MySQLDatabase/MySQLDatabaseConn.php');

function create_new_program_existing_agency($conn,$info_array)
{    
    $query = "INSERT INTO program(referal,name,notes,addr,agency,p_contact,s_contact,descript)
        VALUES( '".$info_array['referal']."','".$info_array['name']."','".$info_array['notes']."'
            ,".$info_array['addr'].",".$info_array['agency'].",".$info_array['p_contact'].",
                ".$info_array['s_contact'].",'".$info_array['descript']."')";
    try{
        $conn->query($query);
    }
    catch(Exception $e){
        echo $e;
    }
    $query2 = "SELECT id
                    FROM program
                    ORDER BY id DESC
                    Limit 0,1";
    // get id of last program inserted
    try{
        $conn->query($query2);
    }
    catch(Exception $e){
        echo $e;
    }
    $program_id = $conn->fetchRowAsAssoc();
    
    $s_id = create_new_s_contact($conn, $info_array['s_contact'],$program_id['id']);
    create_new_issue_assoc($conn, $program_id['id'], $info_array['issues']);
    
    $query3 = "UPDATE program
        SET s_contact = $s_id
        WHERE id = ".$program_id['id'];
    try{
        $conn->query($query3);
    }
    catch(Exception $e){
        echo $e;
    }
    
    return $program_id['id'];
}

/*
function create_new_program_new_agency($conn,$info_array)
{
    $query = "INSERT INTO program(referal,name,notes,addr,agency,p_contact,s_contact,descript)
        VALUES( '".$info_array['referal']."','".$info_array['name']."','".$info_array['notes']."'
            ,".$info_array['addr'].",".$info_array['agency'].",".$update['p_contact'].",
                ".$update['s_contact'].",'".$info_array['descript']."')";

    $conn->query($query);
    // get id of last program inserted
    
    $program_id = "SELECT id
                    FROM program
                    ORDER BY id DESC
                    Limit 1,1";
    
    // get id of last program inserted
    
    return $program_id;

}
 * 
 */
?>
