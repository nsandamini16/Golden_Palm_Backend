<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

// Check if a user is logged in
if (is_logged_in()) {
    // If logged in, redirect to the dashboard
    redirect("dashboard.php");
} else {
    // Otherwise, direct them to the frontend index page
    redirect("index.html");
}
?>
