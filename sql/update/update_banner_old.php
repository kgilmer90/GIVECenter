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

update_banner_old($conn, $_POST);
header("Location:../../Admin.php");

/**
 *  Function is used for updating the current banner with one that is already been used
 * @param type $conn 
 * @param type $post pass $post variable with 'image_id' set to new banner
 */

//  Path is being set to null

function update_banner_old($conn,$post){
        
    // create new banner entry to hold new one
    $query1 = "INSERT INTO image_paths(image_type)
            VALUES('banner')";
    try{
    $conn->query($query1,$conn);
    }
    catch(Exception $e){
        echo $e;
    }

    // find old banner selected and get info
    $query2 = "SELECT id
        FROM image_paths
        ORDER BY id DESC
        LIMIT 0,1";
    try{
    $conn->query($query2,$conn);
    }
    catch(Exception $e){
        echo $e;
    }
    $id = $conn->fetchRowAsAssoc();

    //get path of banner to return for use
    $query3 = "SELECT path
        FROM image_paths
        WHERE id = ".$post['set_banner'];
    try{
    $conn->query($query3,$conn);
    }
    catch(Exception $e){
        echo $e;
    }
    
    if($conn->numRows() == 0){
        header('Location:../../Admin.php?error=bad_id');
    }
    
    $file = $conn->fetchRowAsAssoc();   
    
    // update new banner entry to match the old one
    $query4 = "UPDATE image_paths
        SET path = '".$file['path']."'
        WHERE id =".$id['id'];
    try{
    $conn->query($query4,$conn);
    }
    catch(Exception $e){
        echo $e;
    }
    //remove old copy of the banner
    //  Delete is working
    $query5 = "DELETE FROM image_paths
        WHERE id = ".$post['set_banner'];  
    try{
    $conn->query($query5,$conn);
    }
    catch(Exception $e){
        echo $e;
    }
    
    // in case of an error, remove null path entries
    $query6 = "DELETE FROM image_paths
        WHERE path = 'null' OR path = ''";
    $conn->query($query6);
    
    return 0;
}
?>
