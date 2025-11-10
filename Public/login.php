<?php

require_once 'config.php';
session_start();

$error_message = '';
const CORRECT_PASSWORD_HASH = 'b14e9015dae06b5e206c2b37178eac45e193792c5ccf1d48974552614c61f2ff';
$file = 'login_attempts.json'; 

$username_value = $_COOKIE['todo-username'] ?? '';

function getBasePath(): string {
    if ($_SERVER['SERVER_NAME'] === 'localhost') {
        return '/LucasEspaladori.github.io/Public/';
    } else if ($_SERVER['SERVER_NAME'] === 'osiris.ubishops.ca'){
        return '/username/';
    }
    return '/';
}

if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    $BASE_PATH = getBasePath();
    $location_url = 'http://' . $_SERVER['HTTP_HOST'] . $BASE_PATH . 'todo-list.php';
    header('Location: ' . $location_url);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    $user = htmlspecialchars(trim($_POST['username'] ?? ''));
    $submitted_password = $_POST['password'] ?? '';
    $submitted_hash = hash('sha256', $submitted_password);

    $username_value = $user;

    $attempts = [];
    if (file_exists($file)) {
        $attempts = json_decode(file_get_contents($file), true);
    }

    if (!isset($attempts[$user])) { /* */
        $attempts[$user] = [ /* */
            'attempts' => 0, /* */
            'locked_until' => '' /* */
        ];
    }

    if ($attempts[$user]['locked_until'] > time()) { /* */
        $remaining_time = $attempts[$user]['locked_until'] - time();
        $error_message = "Locked out, sorry. Remaining time: $remaining_time seconds.";
        
    } else {    

        if ($submitted_hash === CORRECT_PASSWORD_HASH) {

            $attempts[$user]['attempts'] = 0;

            $_SESSION['authenticated'] = true;
            $BASE_PATH = getBasePath();
            setcookie('todo-username', $user, time() + (86400 * 30), $BASE_PATH);

            $location_url = 'http://' . $_SERVER['HTTP_HOST'] . $BASE_PATH . 'todo-list.php';
            header('Location: ' . $location_url);
            exit();

        } else {

            $attempts[$user]['attempts'] += 1; /* */
            $current_attempts = $attempts[$user]['attempts'];

            if ($current_attempts >= 3) {
                $attempts[$user]['locked_until'] = time() + (30); /* */
                $attempts[$user]['attempts'] = 0; /* */
                $error_message = "Three wrong attempts. Locked out for 30 secs.";
            } else {
                $error_message = "Wrong password. Try again. This is your attempt # $current_attempts.";
            }
        }
    }

    file_put_contents($file, json_encode($attempts)); /* */

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
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" value="<?php echo $username_value; ?>" required>
                    </div>
                    <div class="form-group required">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <?php if ($error_message): ?>
                        <p style="color: red; margin-top: 10px; font-weight: bold;"><?php echo $error_message; ?></p>
                    <?php endif; ?>

                    <?php if ($error_message): ?>
                        <p style="color: red; margin-top: 10px; font-weight: bold;"><?php echo $error_message; ?></p>
                    <?php endif; ?>

                    <?php if (isset($_GET['logout']) && $_GET['logout'] == 'success'): ?>
                        <p style="color: green; margin-top: 10px; font-weight: bold;">Successfully logged out!</p>
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