<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * TODO: Update Program Function
 */

function update_program($conn,$program_id,$program)
{
    $query = "DELETE FROM program
        WHERE id = $program_id";
    $conn->query($query);
    
    create_new_program_new_agency($conn, $program);
}
?>
