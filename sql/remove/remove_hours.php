<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function delete_hours($conn,$program_id)
{
    $query="DELETE FROM hours
            WHERE program_id = $program_id";
    $conn->query($query);
}
?>
