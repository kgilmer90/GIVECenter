<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *  Finds Seasons that a specific program operates 
 * @param type $conn database connection
 * @param type $program_id program to find
 * @return $results numeric array containing the seasons
 */
function create_seasons($conn,$program_id)
{
    $query = "SELECT seasons.season
        FROM seasons,program_seasons
        WHERE program = $program_id AND seasons.id = program_seasons.season_id";
    
    $conn->query($query);
    
    if($conn->numRows()==0){
        return null;
    }
    $results = $conn->fetchAllAsNumeric();
    
    return $results;
}
?>