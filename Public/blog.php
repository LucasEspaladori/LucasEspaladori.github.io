<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$is_authenticated = isset($_SESSION['blog_authenticated']) && $_SESSION['blog_authenticated'] === true;


$json_file = __DIR__ . '/blog_posts.json'; 

$error_message = '';
$blog_posts = []; 


$json_data = @file_get_contents($json_file); 

if ($json_data === false) {

    $error_message = "FATAL ERROR: Could not read blog data file. Please ensure 'blog_posts.json' is correctly named and located in the same folder as blog.php.";
} else {

    $blog_posts = json_decode($json_data, true);


    if ($blog_posts === null) {
        $blog_posts = [];
        $error_message = "Error: Could not decode blog_posts.json. Check the JSON syntax.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Lucas Espaladori">
    <title>My Awesome Blog</title>
    <link rel="stylesheet" href="my_style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="body_wrapper"> 
        <header>
            <div class="title-container">
                <a href="index.php" class="header-icon-link">
                    <img src="https://cdn-icons-png.flaticon.com/512/5339/5339181.png" alt="Website Icon" class="header-icon">
                </a>
                <h1>My Awesome Blog</h1>
            </div>
            <?php require_once 'nav.php'; ?>
        </header>

        <main class="main-content">
            <section class="hero-blog">
                <h2>Exploring the Tech World and Beyond!</h2>
                <p>Welcome to my personal blog where I share insights into computer engineering, review the latest tech gadgets, and sometimes diverge into my other passions like cooking and gaming. This is where the code meets creativity!</p>
            </section>
            
            <hr>
            
            <?php?>
                <?php?>
            <div class="row blog-layout">

                
                <section class="col-md-8 blog-posts-main">

                    <h3>Latest Posts</h3>
                    
                    <?php 
                    // Display error if loading failed
                    if (isset($error_message) && $error_message !== "") {
                        echo "<p style='color: red; font-weight: bold;'>$error_message</p>";
                    }
                    ?>
                    
                    <div id="posts-container">
                        <?php 
                        if (!empty($blog_posts)) {
                            foreach (array_reverse($blog_posts, true) as $post_id => $post_data) {
                                echo '<article class="blog-post card p-3 mb-4" id="' . $post_id . '">';
                                if (isset($_SESSION['blog_authenticated']) && $_SESSION['blog_authenticated'] === true) { 
                                    echo '<form action="delete_post.php" method="POST" class="delete-form" onsubmit="return confirm(\'Are you sure you want to delete the post: \\\''. htmlspecialchars($post_data['title'], ENT_QUOTES) . '\\\'?\');">';
                                    echo '<input type="hidden" name="post_id" value="' . htmlspecialchars($post_id) . '">';
                                    echo '<button type="submit" class="delete-btn">Delete Post</button>';
                                    echo '</form>';
                                }
                                
                                echo '<span class="post-meta">Posted on ' . htmlspecialchars($post_data['date']) . '</span>';
                                echo '<h4>' . htmlspecialchars($post_data['title']) . '</h4>';
                                foreach ($post_data['paragraphs'] as $paragraph) {
                                    echo '<p>' . htmlspecialchars($paragraph) . '</p>';
                                }
                                
                                echo '</article>';
                            }
                        } else {
                            if (empty($error_message)) {
                                echo '<p>No blog posts found. The JSON file is empty.</p>';
                            }
                        }
                        ?>
                    </div>
                </section>

                <aside class="col-md-4 blog-aside-list">

                    <h3>All Posts</h3>
                    <ul id="post-list-aside">
                        <?php
                        if (!empty($blog_posts)) {
                            foreach ($blog_posts as $post_id => $post_data) {
                                echo '<li><a href="#' . $post_id . '">' . htmlspecialchars($post_data['title']) . '</a></li>';
                            }
                        } else {
                            echo '<li>No posts available.</li>';
                        }
                        ?>
                    </ul>
                </aside>
            </div>
        </main>

        <?php require_once 'footer.php'; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>