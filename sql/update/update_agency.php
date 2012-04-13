<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * TODO: Update Agency Function
 */

function update_agency($conn,$agency_id,$agency)
{
    $query = "DELETE FROM agency
        WHERE id = $agency_id";
    $conn->query($query);
    
    $new_agency = create_new_agency($conn, $agency);
    return $new_agency;
}
?>