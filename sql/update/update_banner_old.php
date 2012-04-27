<?php

include_once(dirname(__FILE__).'/../../php/MySQLDatabase/MySQLDatabaseConn.php');
include_once(dirname(__FILE__).'/../../php/ini/GIVECenterIni.php');

$conn =0;
try{
$conn = new MySQLDatabaseConn($GIVE_MYSQL_SERVER, $GIVE_MYSQL_DATABASE, $GIVE_MYSQL_UNAME, $GIVE_MYSQL_PASS);
}
catch(Exception $e){
    echo $e;
}

/****************************************************************************
 * Check for Login
 ****************************************************************************/

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


/*********************************************8******************************
 * Run Update
 * **************************************************************************/

update_banner_old($conn, $_POST) or die("bad update!");
header("../../add_edit.php");

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
        ORDER BY id
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
        ORDER BY id DESC";
    
    $conn->query($query);
    
    $banners = $conn->fetchAllAsAssoc();
    
    return $banners;
}
?>
