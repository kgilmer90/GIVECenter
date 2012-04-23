<?php

include_once('php/MySQLDatabase/MySQLDatabaseConn.php');

$conn = new MySQLDatabaseConn($GIVE_MYSQL_SERVER, $GIVE_MYSQL_DATABASE, $GIVE_MYSQL_UNAME, $GIVE_MYSQL_PASS);
$update = array();

//to hold various error states
$error = array();

//set to 'failed' if previous login attempt yielded no matches for the uname/pass combo
if(isset($_GET['login'])) {
	$error['login'] = $_GET['login'];
}
//set to 'true' if user was redirected to the login page via another page's logout button
if(isset($_GET['logout'])) {
	$error['logout'] = $_GET['logout'];
}
//set to 'conn' if an exception was thrown during login connecting to the database
//set to 'query' if an exception was thrown during login querying the database
if(isset($_GET['except'])) {
	$error['except'] = $_GET['except'];
}
//set to the error code resulting from an exception during login
if(isset($_GET['code'])) {
	$error['code'] = $_GET['code'];
}

upload_banner($conn, $_FILES);

/**
 *  Function takes image named in form and copies it into the img folder
 *  and updates the path of the banner in the database
 * @param type $con     Database connection
 * @param type $files  $_FILES variable
 */
function upload_banner($con, $files){
    if ($files['banner']['error'] === UPLOAD_ERR_OK)
    {
            $name = "img/".$files['banner']['name'];
            move_uploaded_file($files['banner']['tmp_name'], $name) or die("bad move");
            echo "Uploaded image '$name'<br />";
            update_banner($con, $files['banner']['name']);
    }

    else {
        echo "<p> upload error! lol ".$files['banner']['error']."</p>";
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

/*
 <form action="sql/update/update_banner.php" method="post" enctype="multipart/form-data" name="uploadImage" id="uploadImage">
        <input type="file" name="banner" id="banner" />
        <input type="submit" value="Send"></div>
    </form> 
 
 */


?>