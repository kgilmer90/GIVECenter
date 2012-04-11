<?php

/*
 * TODO: SOLVE Dependencies for Update Functions
 * TODO: Show Ian how functions work -> require all knowledge including existing passed
 */

function update_addr($conn,$addr_id,$new_addr)
{
    $query = "DELETE FROM addr
                WHERE id=$addr_id";
    $conn->query($query);
    
    $addr_id = create_new_addr($conn, $new_addr);
    
    return $addr_id;
}
?>

