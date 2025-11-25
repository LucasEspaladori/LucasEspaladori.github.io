<?php
session_start();

// Unset the specific blog authentication session variable
if (isset($_SESSION['blog_authenticated'])) {
    unset($_SESSION['blog_authenticated']);
}

// Redirect back to the blog page
header('Location: blog.php');
exit;
?>