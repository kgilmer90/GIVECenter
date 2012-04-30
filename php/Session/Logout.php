<?php
session_start();

//Logout script, unsets Session variables and redirects back
//to login page

unset($_SESSION['username']);
unset($_SESSION['admin']);
header('Location: ../../LoginPage.php?logout=true');
?>