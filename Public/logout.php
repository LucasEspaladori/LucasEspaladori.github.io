<?php
session_start(); // Start the session to access session data

// 1. Unset all session variables
$_SESSION = array();

// 2. Destroy the session
session_destroy();

// 3. --- Redirection Logic to return to login page ---
$BASE_PATH = ''; 
if ($_SERVER['SERVER_NAME'] === 'localhost') {
    $BASE_PATH = '/LucasEspaladori.github.io/Public/'; 
} else if ($_SERVER['SERVER_NAME'] === 'osiris.ubishops.ca'){
    $BASE_PATH = '/username/'; 
} else {
    $BASE_PATH = '/';
}

$login_url = 'http://' . $_SERVER['HTTP_HOST'] . $BASE_PATH . 'login.php';

header('Location: ' . $login_url);
exit();
?>