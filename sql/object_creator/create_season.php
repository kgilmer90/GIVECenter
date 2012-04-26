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
    $query = "SELECT seasons.id
        FROM seasons,program_seasons
        WHERE program_seasons.program_id = $program_id AND seasons.id = program_seasons.season_id";
    
    $conn->query($query);
    
    if($conn->numRows()==0){
        return null;
    }
    $seasons = array();
    $results = $conn->fetchAllAsAssoc();
    foreach($results as $temp){
        array_push($seasons,$temp['id']);
    }
    
    return $seasons;
}

/*
CREATE TABLE program_seasons(
    program_id INT UNSIGNED,
    season_id INT UNSIGNED,
    PRIMARY KEY(program_id,season_id)) ENGINE INNODB;
CREATE TABLE seasons(
    id INT UNSIGNED NOT NULL PRIMARY KEY,
    season VARCHAR(10)) ENGINE INNODB;  
*/
?>