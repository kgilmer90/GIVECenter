<?php
session_start();

unset($_SESSION['username']);
header('Location: ../../LoginPage.php?logout=true');
?>