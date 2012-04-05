<?php

/**
 * Login.php
 * 
 * Used as the action property of the login form in LoginPage.php.
 */
session_start();

include_once('../ini/cred_manipulation.php');
include_once('../ini/GIVECenterIni.php');
include_once('../MySQLDatabaseConn.php');

$uname = $_POST['username'];
$passwd = $_POST['password'];

$conn;
try {
	$conn = new MySQLDatabaseConn($GIVE_MYSQL_SERVER, $GIVE_MYSQL_DATABASE, $GIVE_MYSQL_UNAME, $GIVE_MYSQL_PASS);
	
	if(check_user($conn, $uname, $passwd)) {
		$_SESSION['username'] = $uname;
		header('../../html_css/HomepageJS.php');
	}
	else {
		header('../../html_css/LoginPage.php?login=failed');
	}
}
catch(MySQLDatabaseConnException $e) {
	$_SESSION['except'] = $e;
	header('../../html_css/LoginPage.php?except=conn');
}
catch(MySQLQueryFailedException $e) {
	$_SESSION['except'] = $e;
	header('../../html_css/LoginPage.php?except=query');
}
?>