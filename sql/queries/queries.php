<?php

/*
 * Random Queries
 */


// Find latest Version of the banner and return its path
function get_banner_latest($conn)
{
    $query = "SELECT path
        FROM image_paths
        WHERE image_type = 'banner'
        ORDER BY id DESC
        LIMIT 0,1";
        
    $conn->query($query);
    
    $results = $conn->fetchRowAsAssoc();

    return $results['path'];
}

?>
