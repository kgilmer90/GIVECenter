<?php
session_start();

unset($_SESSION['username']);
unset($_SESSION['admin']);
header('Location: ../../LoginPage.php?logout=true');
?>