<?php

$GIVE_MYSQL_SERVER = 'localhost';
$GIVE_MYSQL_DATABASE = 'give_ctr_agencies';
$GIVE_MYSQL_UNAME = 'bgs';
$GIVE_MYSQL_PASS = 'dki2012!';

$GIVE_INSTALL_SYSTEM = 'windows';

$GIVE_INSTALL_PATH;
if($GIVE_INSTALL_SYSTEM == 'windows') {
	$GIVE_INSTALL_PATH = "C:\\xampp\\htdocs\\GIVECenter\\";
}
else if($GIVE_INSTALL_SYSTEM == 'linux') {
	$GIVE_INSTALL_PATH = '/var/opt/lampp/htdocs/GIVECenter/';
}

?>