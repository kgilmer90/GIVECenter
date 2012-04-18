<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * TODO: Set Addr point in program to null
 */

    function remove_addr($conn,$addr_id,$program_id)
    {
        $query="DELETE FROM addr
                WHERE id = $addr_id";
        $conn->query($query);
        
        $query = "UPDATE program
                    SET addr = 'NULL'
                    WHERE id = $program_id";
        $conn->query($query);
    }
?>
