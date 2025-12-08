<?php
session_start();

if (!isset($_SESSION['blog_authenticated']) || $_SESSION['blog_authenticated'] !== true) {
    header('Location: login_blog.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
    $post_id_to_delete = $_POST['post_id'];
    $json_file = __DIR__ . '/blog_posts.json';

    $json_data = @file_get_contents($json_file);
    $blog_posts = json_decode($json_data, true);

    if (is_array($blog_posts) && isset($blog_posts[$post_id_to_delete])) {
        unset($blog_posts[$post_id_to_delete]);
        file_put_contents($json_file, json_encode($blog_posts, JSON_PRETTY_PRINT));
    }
}

header('Location: blog.php');
exit;
?>
