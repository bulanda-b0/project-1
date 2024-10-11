<?php
 
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect the user to the login page
    header('Location: login.php');
    exit;
}

$_SESSION = array();
session_unset();
session_destroy();

header('Location: login.php');
exit;
?>