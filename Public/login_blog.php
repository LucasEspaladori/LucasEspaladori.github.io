<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if already logged in
if (isset($_SESSION['blog_authenticated']) && $_SESSION['blog_authenticated'] === true) {
    header('Location: blog.php');
    exit;
}

$error_message = '';
// The correct hash for 'CS203'
$hashed_password = '$2y$10$w/X0B8g6P.1.M4wHqD2gIuD4T.z2vN.x.T.R1c0uE/5A5c0q.J2O'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_password = $_POST['password'] ?? '';

    // Verify the password
    if (password_verify($input_password, $hashed_password)) {
        $_SESSION['blog_authenticated'] = true;
        
        // Success: Redirect to the blog page
        header('Location: blog.php');
        exit;
    } else {
        $error_message = 'Invalid password. Please try again.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog Login</title>
    <link rel="stylesheet" href="my_style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
</head>
<body>
    <div class="body_wrapper"> 
        <header>
            <h1>Blog Admin Login</h1>
            <?php require_once 'nav.php'; ?>
        </header>

        <main class="main-content form-page">
            <section class="form-container">
                <h2>Access Blog Management</h2>
                
                <?php if ($error_message): ?>
                    <p style="color: red; font-weight: bold;"><?php echo htmlspecialchars($error_message); ?></p>
                <?php endif; ?>

                <form action="login_blog.php" method="POST">
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit">Log In</button>
                </form>
            </section>
        </main>

        <?php require_once 'footer.php'; ?>
    </div>
</body>
</html>