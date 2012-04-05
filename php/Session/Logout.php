<?php
session_start();

unset($_SESSION['username']);
header('../../html_css/LoginPage.php?logout=true');
?>