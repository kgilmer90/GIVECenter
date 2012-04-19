<?php

/**
 *  Function takes image named in form and copies it into the img folder
 *  and updates the path of the banner in the database
 * @param type $con     Database connection
 * @param type $files  $_FILES variable
 */
function upload_banner($con, $files){
    if ($files['filename']['error'] === UPLOAD_ERR_OK)
    {
            $name = "img/".$files['filename']['name'];
            move_uploaded_file($files['filename']['tmp_name'], $name) or die("bad move");
            echo "Uploaded image '$name'<br />";
            update_banner($con, $files['filename']['name']);
    }

    else {
        echo "<p> upload error! lol ".$files['filename']['error']."</p>";
    }
}

/**
 *  Updates GIVE Center Website Banner
 * @param type $con Database connection
 * @param type $path Path to New 
 */
function update_banner($con,$path)
{
    $query = "UPDATE image_paths
                SET path = $path
                WHERE name = 'banner'";
    $con->query($query);
}

?>