<?php
session_start();

// Check for authentication
if (!isset($_SESSION['blog_authenticated']) || $_SESSION['blog_authenticated'] !== true) {
    // If not authenticated, redirect to login page
    header('Location: login_blog.php');
    exit;
}

// Check if a post ID was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
    
    $post_id_to_delete = $_POST['post_id'];
    $json_file = __DIR__ . '/blog_posts.json';

    // 1. Load existing posts
    $json_data = @file_get_contents($json_file);
    $blog_posts = json_decode($json_data, true);

    if ($blog_posts === null) {
        // Handle error: JSON file is unreadable or malformed
        error_log("Error decoding blog_posts.json during delete attempt.");
    } elseif (isset($blog_posts[$post_id_to_delete])) {
        
        // 2. Remove the post
        unset($blog_posts[$post_id_to_delete]);

        // 3. Encode and save the updated array
        if (file_put_contents($json_file, json_encode($blog_posts, JSON_PRETTY_PRINT)) === false) {
            error_log("Error writing back to blog_posts.json after deleting post ID: " . $post_id_to_delete);
        }
    }
}

// Redirect back to the blog page regardless of success/failure (the blog page will no longer show the post)
header('Location: blog.php');
exit;
?>