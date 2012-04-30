<?php

/*
        remove address matching program id
 * 
 */

    function remove_addr_from_program($conn,$addr_id,$program_id)
    {
        // remove address
        $query1="DELETE FROM addr
                WHERE id = $addr_id";
        
        // remove addr pointer from program
        $query2 = "UPDATE program
                    SET addr = 'NULL'
                    WHERE id = $program_id";
        try{
            $conn->query($query1);    
        }
        catch(Exception $e){
            echo $e;
        }
        try{
            $conn->query($query2);    
        }
        catch(Exception $e){
            echo $e;
        }
    }
?>
