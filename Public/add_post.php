<?php
session_start();

// Check for authentication
if (!isset($_SESSION['blog_authenticated']) || $_SESSION['blog_authenticated'] !== true) {
    header('Location: login_blog.php');
    exit;
}

$error_message = '';
$success_message = '';
$json_file = __DIR__ . '/blog_posts.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Sanitize user input
    $title = trim($_POST['title'] ?? '');
    $body = trim($_POST['body'] ?? '');
    
    // Simple validation
    if (empty($title) || empty($body)) {
        $error_message = "Title and Post Body cannot be empty.";
    } else {
        // Break the body into paragraphs
        $paragraphs = explode("\n", str_replace("\r", "", $body));
        $cleaned_paragraphs = [];
        
        foreach ($paragraphs as $p) {
            $p = trim($p);
            if (!empty($p)) {
                // Apply sanitation to each paragraph
                $cleaned_paragraphs[] = htmlspecialchars($p, ENT_QUOTES, 'UTF-8');
            }
        }

        // 2. Prepare the new post data
        $new_post_data = [
            "date" => date('F d, Y'), // Current date
            "title" => htmlspecialchars($title, ENT_QUOTES, 'UTF-8'),
            "paragraphs" => $cleaned_paragraphs
        ];
        
        // 3. Load existing posts
        $blog_posts = json_decode(@file_get_contents($json_file), true) ?? [];
        
        // 4. Generate a unique ID (simple increment or use timestamp for uniqueness)
        $new_id_number = count($blog_posts) + 1;
        $new_post_id = "post_" . $new_id_number . "_" . substr(md5(microtime()), 0, 6);
        
        $blog_posts[$new_post_id] = $new_post_data;

        // 5. Encode and save the updated array
        if (file_put_contents($json_file, json_encode($blog_posts, JSON_PRETTY_PRINT)) !== false) {
            $success_message = "New post successfully added! <a href='blog.php'>View the blog.</a>";
            // Clear inputs after success
            $title = $body = ''; 
        } else {
            $error_message = "FATAL ERROR: Could not write to the blog file. Check file permissions.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Blog Post</title>
    <link rel="stylesheet" href="my_style.css">
</head>
<body>
    <div class="body_wrapper"> 
        <header>
            <h1>Add New Blog Post</h1>
            <?php require_once 'nav.php'; ?>
        </header>

        <main class="main-content form-page">
            <section class="form-container">
                <h2>Write a New Article</h2>
                
                <?php if ($error_message): ?>
                    <p style="color: red; font-weight: bold;"><?php echo htmlspecialchars($error_message); ?></p>
                <?php endif; ?>
                
                <?php if ($success_message): ?>
                    <p style="color: green; font-weight: bold;"><?php echo $success_message; ?></p>
                <?php endif; ?>

                <form action="add_post.php" method="POST">
                    <div class="form-group">
                        <label for="title">Post Title:</label>
                        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title ?? ''); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="body">Post Body (one paragraph per line):</label>
                        <textarea id="body" name="body" rows="15" required><?php echo htmlspecialchars($body ?? ''); ?></textarea>
                    </div>
                    
                    <button type="submit">Publish Post</button>
                </form>
            </section>
        </main>

        <?php require_once 'footer.php'; ?>
    </div>
</body>
</html>