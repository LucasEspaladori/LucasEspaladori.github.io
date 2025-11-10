<?php
session_start(); // <-- NEW: Must be the very first thing in the file

// Define the correct password as its SHA-256 hash value.
$CORRECT_PASSWORD_HASH = 'b14e9015dae06b5e206c2b37178eac45e193792c5ccf1d48974552614c61f2ff';
$error_message = '';
$is_authenticated = false;

// Check if a password was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    $submitted_password = $_POST['password'];

    $submitted_hash = hash('sha256', $submitted_password);

    if ($submitted_hash === $CORRECT_PASSWORD_HASH) {
        $is_authenticated = true;
        $_SESSION['authenticated'] = true; 
        
        // --- Redirection Logic ---
        $BASE_PATH = ''; 
        
        if ($_SERVER['SERVER_NAME'] === 'localhost') {
            // Using your confirmed path
            $BASE_PATH = '/LucasEspaladori.github.io/Public/'; 
        } else if ($_SERVER['SERVER_NAME'] === 'osiris.ubishops.ca'){
            $BASE_PATH = '/username/'; 
        } else {
            $BASE_PATH = '/';
        }
        
        $location_url = 'http://' . $_SERVER['HTTP_HOST'] . $BASE_PATH . 'todo-list.php';

        header('Location: ' . $location_url);
        exit(); 
        
    } else {
        $error_message = 'Incorrect password. Please try again.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Lucas Espaladori">
    <title>To-Do List Login</title>
    <link rel="stylesheet" href="my_style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <div class="body_wrapper"> 
        <header>
            <div class="title-container">

                <a href="index.php" class="header-icon-link">
                 <img src="https://cdn-icons-png.flaticon.com/512/5339/5339181.png" alt="Website Icon" class="header-icon">
                </a>

        <h1>To-Do List Login</h1>

        </div>

    <?php require_once 'nav.php'; ?>

</header>

        <div class="main-content">
            <h2>Enter Password to Access To-Do List</h2>
            
            <form action="login.php" method="post" class="programmer-quiz-form">
                <fieldset>
                    <legend>Access Control</legend>

                    <div class="form-group required">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <?php if ($error_message): ?>
                        <p style="color: red; margin-top: 10px; font-weight: bold;"><?php echo $error_message; ?></p>
                    <?php endif; ?>

                    <div class="form-group">
                        <button type="submit">Submit</button>
                    </div>
                </fieldset>
            </form>

        </div>

        <hr>
        
        <?php require_once 'footer.php'; ?>
    </div>
</body>
</html>