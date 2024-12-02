<?php
session_start();

// Check if there is an active session
if (isset($_SESSION)) {
    // Destroy the session
    session_unset();
    session_destroy();
}

// Redirect to the homepage after logout
header("Location: JKDMHomepage.php");
exit;
?>
