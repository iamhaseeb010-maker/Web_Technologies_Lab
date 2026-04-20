<?php
/**
 * Abdul Haseeb | Lab 3 Secure Logout
 * Ensures all session data is cleared and cookies are invalidated.
 */

session_start();

// 1. Unset all session variables
$_SESSION = array();

// 2. If it's desired to kill the session, also delete the session cookie.
// This is more secure than just destroy() alone.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3. Finally, destroy the session.
session_destroy();

// 4. Redirect to login with a logout flag (optional)
header("Location: login.php?logout=1");
exit;
?>