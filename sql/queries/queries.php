<?php

/*
 * QUERIES FOR ADVANCED SEARCH
 * 
 */

    /**
     *  Queries Database for List of All Issues for Advanced Search
     * @param type $conn    database connection
     * @return type     Num'd Sock'd Array of Issues: id,name
     */

function get_banner_latest($conn)
{
    $query = "SELECT path
        FROM image_paths
        WHERE type = 'banner'
        ORDER BY id DESC
        LIMIT 0,1";
        
    $conn->query($query);
    
    $results = $conn->fetchRowAsNumeric();

    return $results;
}

?>
