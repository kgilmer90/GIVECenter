<?php
//Loaded by default when no exact page name is specified.
//Redirects to Homepage.php. Homepage.php will in turn
//redirect to LoginPage.php if not properly logged in.
header('Location: Homepage.php');
?>