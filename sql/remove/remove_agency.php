<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */

/**
 *  Remove specified agency
 * @param type $conn    db connection
 * @param type $id      id of agency to remove
 * @return int Returns 1 if there is a program still associated with said agency
 */
function remove_agency($conn,$id){
    
    $query1 = "SELECT agency
        FROM program
        WHERE agency = $id";
    
    $query2 = "DELETE FROM agency
        WHERE id=$id";
    $conn->query($query1);
    
    if ($conn->numRows() != 0){
        return 1;
    }
    
    else{
        $conn->query($query2);
        return 0;
    }
    
}

function agency_empty($conn,$agency_id){
    $query = "SELECT program.id
        FROM program, agency
        WHERE agency.id = $agency_id
        AND agency.id = program.agency";
    $conn->query($query);
    $results = $conn->numRows();
    
    if ($results > 0){
        return false;
    }
    else{
        return true;
    }
}
?>
