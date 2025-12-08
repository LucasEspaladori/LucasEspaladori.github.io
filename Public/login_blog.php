<?php
// Optional: include config if you use custom session save path
// require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// If already logged in, go to blog
if (!empty($_SESSION['blog_authenticated']) && $_SESSION['blog_authenticated'] === true) {
    header('Location: blog.php');
    exit;
}

$error_message = '';
$hashed_password = '$2y$10$gF9.9HFqb.WOULXLQ6cd.O..oQxhb/w9EaycB4pALeXwtHdHsITSy';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_password = trim($_POST['password'] ?? '');


    if (password_verify($input_password, $hashed_password)) {
        // Prevent session fixation and store login state
        session_regenerate_id(true);
        $_SESSION['blog_authenticated'] = true;

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
    <meta name="author" content="Lucas Espaladori">
    <title>Blog Admin Login</title>
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
                <h1>Blog Admin Login</h1>
            </div>
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

        <?php require_once __DIR__ . '/footer.php'; ?>
    </div>
</body>
</html>