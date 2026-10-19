<?php
// Start secure session
session_start();

// Regenerate session ID to prevent session fixation
session_regenerate_id(true);

// Unset all session variables
$_SESSION = array();

// Clear session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), 
        '', 
        time() - 42000,
        $params["path"], 
        $params["domain"],
        $params["secure"], 
        $params["httponly"]
    );
}

// Destroy the session completely
session_destroy();

// Set logout message in cookie (will be displayed after redirect)
setcookie(
    'logout_message', 
    'You have been successfully logged out. Thank you for using the Blood Bank System.', 
    time() + 60,
    '/',
    '', 
    true,  // Secure flag
    true   // HttpOnly flag
);

// Set security headers
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: strict-origin-when-cross-origin");

// Redirect to login page with anti-caching headers
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Location: login.php");

// Ensure no further code is executed
exit();
?>
