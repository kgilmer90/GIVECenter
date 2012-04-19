<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * TODO: Set Addr point in program to null
 */

    function remove_addr_from_program($conn,$addr_id,$program_id)
    {
        $query1="DELETE FROM addr
                WHERE id = $addr_id";
        
        $query2 = "UPDATE program
                    SET addr = 'NULL'
                    WHERE id = $program_id";
        $conn->query($query1);
        $conn->query($query2);
    }
?>
