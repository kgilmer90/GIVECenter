<?php

/**
 *
 * @param type $conn 
 * @param type $post pass $post variable with 'image_id' set to new banner
 */
function update_banner_old($conn,$post){
    $query1 = "INSERT INTO image_paths('banner')
            VALUES(image_type)";
    $conn->query($query1,$conn);

    $query2 = "SELECT id
        FROM image_paths
        SORT BY id
        LIMIT 0,1";
    $conn->query($query2, $conn);
    $id = $conn->fetchRowAsAssoc();

    $query3 = "SELECT path
        FROM image_paths
        WHERE id = ".$post['id'];
    $conn->query($query3);
    if($conn->fetchRows() == 0)
        header('../../Admin.php?error=bad_id');
    
    $file = $conn->fetchRowAsAssoc();
    
    $query4 = "UPDATE image_paths
        SET path =".$file['path'].
        "WHERE id =".$id['id'];
    $conn->query($query4);

    $query5 = "DELETE FROM image_paths
        WHERE id = ".$post['id'];  
    $conn->query($query5);
    
    header('../../Admin.php');
}

function get_banners($conn){
    $query = "SELECT id,path
        FROM image_paths
        WHERE image_type = 'banner'
        SORT BY id DESC";
    $conn->query($query);
    
    $banners = $conn->fetchAllAsAssoc();
    
    return $banners;
}
?>
