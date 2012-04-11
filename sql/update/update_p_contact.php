<?php

/*
 * Here we can either update, or we can delete and start over
 * 
 */

function update_p_contact($conn,$p_id,$new_p_contact)
{
    $query = "DELETE FROM pro_contact
                WHERE id=$p_id";
    $conn->query($query);
    
    $p_id = create_new_p_contact($conn, $new_p_contact);
    
    return $p_id;
}


?>
