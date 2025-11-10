<?php
require_once 'config.php'; 
session_start(); 

$_SESSION = array();

session_destroy();

$BASE_PATH = ''; 
if ($_SERVER['SERVER_NAME'] === 'localhost') {
    $BASE_PATH = '/LucasEspaladori.github.io/Public/'; 
} else if ($_SERVER['SERVER_NAME'] === 'osiris.ubishops.ca'){
    $BASE_PATH = '/username/'; 
} else {
    $BASE_PATH = '/';
}

$login_url = 'http://' . $_SERVER['HTTP_HOST'] . $BASE_PATH . 'login.php?logout=success';

header('Location: ' . $login_url);
exit();
?>