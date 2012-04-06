<?php

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
		header('Location: ../Homepage.php');
	}
	else {
		header('../../LoginPage.php?login=failed');
	}
}
catch(MySQLDatabaseConnException $e) {
	header('Location: ../../LoginPage.php?except=conn&code='.$e->getCode());
}
catch(MySQLQueryFailedException $e) {
	header('Location: ../../LoginPage.php?except=query&code='.$e->getCode());
}
?>