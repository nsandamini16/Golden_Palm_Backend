<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page
redirect("../auth.html");
?>
