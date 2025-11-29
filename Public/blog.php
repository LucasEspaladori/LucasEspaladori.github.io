<?php
// Start session (required for login check in nav.php and for later steps)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Assume $is_authenticated is set to false if not logged in (defined in nav.php)
$is_authenticated = isset($_SESSION['blog_authenticated']) && $_SESSION['blog_authenticated'] === true;

// 🎯 FIX: Use __DIR__ to guarantee the script finds the file in the same directory.
$json_file = __DIR__ . '/blog_posts.json'; 

$error_message = '';
$blog_posts = []; 

// 1. Attempt to read the file content. Using @ to suppress the PHP Warning if the file is not found.
$json_data = @file_get_contents($json_file); 

if ($json_data === false) {
    // We update the error message to indicate the path was checked definitively
    $error_message = "FATAL ERROR: Could not read blog data file. Please ensure 'blog_posts.json' is correctly named and located in the same folder as blog.php.";
} else {
    // 2. Decode the JSON string
    $blog_posts = json_decode($json_data, true);

    // 3. Check if decoding failed (e.g., malformed JSON)
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
            
            <?php // if ($is_authenticated): ?>
                <?php // endif; ?>
            <div class="blog-layout">
                
                <section class="blog-posts-main">
                    <h3>Latest Posts</h3>
                    
                    <?php 
                    // Display error if loading failed
                    if (isset($error_message) && $error_message !== "") {
                        echo "<p style='color: red; font-weight: bold;'>$error_message</p>";
                    }
                    ?>
                    
                    <div id="posts-container">
                        <?php 
                        // Mandatory Item 3: Loop through the decoded posts array to generate HTML
                        if (!empty($blog_posts)) {
                            // Loop through posts (array_reverse displays newest posts first, if the JSON is ordered oldest-to-newest)
                            foreach (array_reverse($blog_posts, true) as $post_id => $post_data) {
                                echo '<article class="blog-post" id="' . $post_id . '">';
                                
                                // Mandatory Item 5: Delete Button
                                if (isset($_SESSION['blog_authenticated']) && $_SESSION['blog_authenticated'] === true) { 
                                    echo '<form action="delete_post.php" method="POST" class="delete-form" onsubmit="return confirm(\'Are you sure you want to delete the post: \\\''. htmlspecialchars($post_data['title'], ENT_QUOTES) . '\\\'?\');">';
                                    echo '<input type="hidden" name="post_id" value="' . htmlspecialchars($post_id) . '">';
                                    echo '<button type="submit" class="delete-btn">Delete Post</button>';
                                    echo '</form>';
                                }
                                
                                echo '<span class="post-meta">Posted on ' . htmlspecialchars($post_data['date']) . '</span>';
                                echo '<h4>' . htmlspecialchars($post_data['title']) . '</h4>';
                                
                                // Loop through the paragraphs array for the post body
                                foreach ($post_data['paragraphs'] as $paragraph) {
                                    echo '<p>' . htmlspecialchars($paragraph) . '</p>';
                                }
                                
                                echo '</article>';
                            }
                        } else {
                            // If blog_posts is empty (and no $error_message was set)
                            if (empty($error_message)) {
                                echo '<p>No blog posts found. The JSON file is empty.</p>';
                            }
                        }
                        ?>
                    </div>
                </section>

                <aside class="blog-aside-list">
                    <h3>All Posts</h3>
                    <ul id="post-list-aside">
                        <?php
                        // Mandatory Item 2: Loop again to generate the aside links
                        if (!empty($blog_posts)) {
                            // Iterate over the original array order for a stable list
                            foreach ($blog_posts as $post_id => $post_data) {
                                // Create the hyperlink: href="#ID" points to the article id="ID"
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
</body>
</html>