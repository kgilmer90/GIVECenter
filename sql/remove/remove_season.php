<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function delete_season($conn,$program_id)
{
    $query="DELETE FROM seasons
            WHERE program_id = $program_id";
    $conn->query($query);
}
?>
