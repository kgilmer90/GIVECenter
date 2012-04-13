<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * TODO: UPDATE S Contact Function
 */

function update_s_contact($conn,$s_id,$new_s_contact)
{
    $conn = "DELETE FROM student_contact
        WHERE id = $s_id";
    $conn->query($conn);
    
    $new_s_id = create_new_s_contact($conn, $new_s_contact);
    return $new_s_id;
}
?>
