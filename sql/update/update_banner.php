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


/****************************************************************************
 * GO!
 ****************************************************************************/

update_banner($conn, $_FILES);

/****************************************************************************
 * FUNCTIONS
 ****************************************************************************/

/**
 *  Function takes image named in form and copies it into the img folder
 *  and updates the path of the banner in the database
 * @param type $con     Database connection
 * @param type $files  $_FILES variable
 */
function update_banner_simple($files){
/*
 *  update_banner.php
 * 
 * Simple update just copies the banner in and overwrites the old one so 
 * no database work is needed
 * 
 * Make sure the file is sent to here, and that it labels it banner
 * 
 *  DONT FORGET TO ADD PERMISSIONS FOR www-data ON THE TARGET FOLDER
 * 
 *  Sample Form:
 * 
 * <html><head><title>PHP Form Upload</title></head><body>
    <form method='post' action='update_banner.php' enctype='multipart/form-data'>
        Select File: <input type='file' name='banner' size='10' />
        <input type='submit' value='Upload' />
    </form>
    */


    if(count($files)){
        if($files['banner']['type']!= 'image/jpeg') 
            header('Location:../../Admin.php?error=bad_file_type');

        $path = '../../img/give_banner.jpg';

        if(!copy($files['banner']['tmp_name'], $path) ){ 
            header('Location:../../Admin.php?error='.$files['banner']['error'].'copy_fail');
        }
        else{
            header('Location:../../Admin.php?error='.$files['banner']['error']);
        }
    }   
}


function update_banner($conn,$files){
/*
 *  update_banner.php
 * 
 * adds banner to database then sets as new banner
 * 
 *  DONT FORGET TO ADD PERMISSIONS FOR www-data ON THE TARGET FOLDER
 * 
 *  Sample Form:
 *
  <html><head><title>PHP Form Upload</title></head><body>
    <form method='post' action='update_banner.php' enctype='multipart/form-data'>
        Select File: <input type='file' name='banner' size='10' />
        <input type='submit' value='Upload' />
    </form>
 */


    if(count($files)){
        if($files['banner']['type']!= 'image/jpeg') 
            header('Location:../../Admin.php?error=bad_file_type');
        
        // create new entry to hold the banner
        $query1 = "INSERT INTO image_paths(image_type)
            VALUES('banner')";
        try{
        $conn->query($query1,$conn);
        }
        catch(Exception $e){
            echo $e;
        }
        
        // get id of the newest banner entry
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
        $file = 'img/'.$id['id'].".jpg";
        // use the id for naming the new banner
        $query3 = "UPDATE image_paths
            SET path = '$file'  
            WHERE id =".$id['id'];
        //update image path to match the new name
        try{
        $conn->query($query3,$conn);
        }
        catch(Exception $e){
            echo $e;
        }
        
        $path = "../../".$file;
//        echo "copying from copy ".$files['banner']['tmp_name']." to $path";
        // copy file out of temp space and into img folder, using new name
        if(!copy($files['banner']['tmp_name'], $path) ){
            echo "copy failed!<br/>";
            // try to remvoe banner entry if the copy fails
            $query4 = "DELETE FROM image_paths
                WHERE id = ".$id['id'];
            try{
            $conn->query($query4,$conn);
            }
            catch(Exception $e){
                echo $e;
            }
            header('Location:../../Admin.php?error='.$files['banner']['error'].'copy_fail');
        }
        else{
            header('Location:../../Admin.php');
        }
    }   
}
?>