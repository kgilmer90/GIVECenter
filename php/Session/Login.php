<?php
session_start();
/**
 * Login.php
 * 
 * Used as the action property of the login form in LoginPage.php.
 */
include_once(dirname(__FILE__).'/../ini/cred_manipulation.php');
include_once(dirname(__FILE__).'/../ini/GIVECenterIni.php');
include_once(dirname(__FILE__).'/../MySQLDatabase/MySQLDatabaseConn.php');

$uname = $_POST['username'];
$passwd = $_POST['password'];

$conn;
try {
	//connect to the database
	$conn = new MySQLDatabaseConn($GIVE_MYSQL_SERVER, $GIVE_MYSQL_DATABASE, $GIVE_MYSQL_UNAME, $GIVE_MYSQL_PASS);
	
	//if logging in as guest, set the password to empty string
	//this guarantees any login attempt as guest will succeed regardless of password
	if($uname == $GIVE_UNAME_GUEST) {
		$passwd = '';
	}
	
	//if matching username/password found, redirect to homepage
	//$_SESSION['username'] is set to the login username
	//$_SESSION['admin'] is set to true if logged in as admin, false otherwise
	if(check_user($conn, $uname, $passwd)) {
		$conn->close();
		$_SESSION['username'] = $uname;
		$_SESSION['admin'] = ($uname == $GIVE_UNAME_ADMIN) ? true : false;
		header('Location: ../../Homepage.php');
	}
	//if no matching username/password exists, return the login page
	else {
		$conn->close();
		header('Location: ../../LoginPage.php?login=failed');
	}
}
//database connection error
catch(MySQLDatabaseConnException $e) {
	$conn->close();
	header('Location: ../../LoginPage.php?except=conn&code='.$e->getCode());
}
//SQL query error
catch(MySQLQueryFailedException $e) {
	$conn->close();
	header('Location: ../../LoginPage.php?except=query&code='.$e->getCode());
}
?>