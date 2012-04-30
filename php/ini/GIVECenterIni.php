<?php

//Contains username, password, server, and database name
//required to establish a connection with the database.
//Also lists the usernames for admin and guest accounts.
//All of these may be changed to accomodate different server
//configurations or a need for different usernames.

$GIVE_MYSQL_SERVER = 'localhost';
$GIVE_MYSQL_DATABASE = 'give_ctr_agencies';
$GIVE_MYSQL_UNAME = 'bgs';
$GIVE_MYSQL_PASS = 'dki2012!';

$GIVE_UNAME_ADMIN = 'admin';
$GIVE_UNAME_GUEST = 'guest';

$GIVE_INSTALL_SYSTEM = 'windows';

$GIVE_INSTALL_PATH;
if($GIVE_INSTALL_SYSTEM == 'windows') {
	$GIVE_INSTALL_PATH = "C:\\xampp\\htdocs\\GIVECenter\\";
}
else if($GIVE_INSTALL_SYSTEM == 'linux') {
	$GIVE_INSTALL_PATH = '/var/opt/lampp/htdocs/GIVECenter/';
}
?>