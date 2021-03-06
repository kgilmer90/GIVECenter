<?php
include_once(dirname(__FILE__).'/../../php/MySQLDatabase/MySQLDatabaseConn.php');
include_once(dirname(__FILE__).'/../../php/ini/GIVECenterIni.php');
include_once(dirname(__FILE__).'/../remove/remove_addr.php');
include_once(dirname(__FILE__).'/../remove/remove_agency.php');
include_once(dirname(__FILE__).'/../remove/remove_hours.php');
include_once(dirname(__FILE__).'/../remove/remove_issue.php');
include_once(dirname(__FILE__).'/../remove/remove_p_contact.php');
include_once(dirname(__FILE__).'/../remove/remove_s_contact.php');
include_once(dirname(__FILE__).'/../remove/remove_season.php');
include_once(dirname(__FILE__).'/../remove/remove_program.php');

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
 * Call All Remove Functions!
 ****************************************************************************/

    /*
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    */

if (isset($_POST['program_id'])){
    
    // functions that are independent 
    remove_hours($conn, $_POST['program_id']);
    remove_issues($conn, $_POST['program_id']);
    remove_season($conn, $_POST['program_id']);
    
    // remove objects from database
    if ($_POST['p_contact_id']!= -1){
        remove_p_contact_program($conn, $_POST['program_id']);
    }
    if ($_POST['addr_id']!= -1){
        remove_addr_from_program($conn, $_POST['addr_id'], $_POST['program_id']);
    }
    if ($_POST['s_contact_id'] != -1){
        remove_s_contact_by_id($conn, $_POST['s_contact_id']);
    }
    // tidy up
    remove_program($conn, $_POST['program_id']);
}
    // remove agency
if($_POST['agency_id'] != -1 && agency_empty($conn, $_POST['agency_id'])){
    
    // remove objects
    if ($_POST['p_contact_id']!= -1){
        remove_p_contact_agency($conn, $_POST['agency_id']);
    }
    if ($_POST['addr_id']!= -1){
        remove_addr_from_program($conn, $_POST['addr_id'], $_POST['program_id']);
    }
    
    // tidy up
    remove_agency($conn, $_POST['agency_id']);
    header('Location: ../../Admin.php');
}
else
    header('Location: ../../Admin.php?ageny=not_empty');
?>

