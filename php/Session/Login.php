<?php
session_start();
/**
 * Login.php
 * 
 * Used as the action property of the login form in LoginPage.php.
 */
include_once('../ini/cred_manipulation.php');
include_once('../ini/GIVECenterIni.php');
include_once('../MySQLDatabase/MySQLDatabaseConn.php');

$uname = $_POST['username'];
$passwd = $_POST['password'];

$conn;
try {
	$conn = new MySQLDatabaseConn($GIVE_MYSQL_SERVER, $GIVE_MYSQL_DATABASE, $GIVE_MYSQL_UNAME, $GIVE_MYSQL_PASS);
	
	if(check_user($conn, $uname, $passwd)) {
		$_SESSION['username'] = $uname;
		$conn->close();
		header('Location: ../../Homepage.php');
	}
	else {
		$conn->close();
		header('Location: ../../LoginPage.php?login=failed');
	}
}
catch(MySQLDatabaseConnException $e) {
	$conn->close();
	header('Location: ../../LoginPage.php?except=conn&code='.$e->getCode());
}
catch(MySQLQueryFailedException $e) {
	$conn->close();
	header('Location: ../../LoginPage.php?except=query&code='.$e->getCode());
}
?>