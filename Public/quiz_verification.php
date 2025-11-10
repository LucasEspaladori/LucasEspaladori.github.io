<?php
function redirectToFormWithError($message) {
    header("Location: my_form.php?error=" . urlencode($message));
    exit();
}

if (empty($_GET['user_name']) || empty($_GET['user_email']) || empty($_GET['question1']) || empty($_GET['question4'])) {
    redirectToFormWithError("Missing required fields (Name, Email, Question 1, or Question 4).");
}

$userName = htmlspecialchars($_GET['user_name']);
$userEmail = htmlspecialchars($_GET['user_email']);
$q1Score = intval($_GET['question1']); // 1, 3, or 5
$q3Number = isset($_GET['question3']) ? intval($_GET['question3']) : 0;
$q4Score = intval($_GET['question4']); // 1, 3, or 5
$q5Score = isset($_GET['question5']) ? intval($_GET['question5']) : 5; 


$q2Points = 0;
if (isset($_GET['question2']) && is_array($_GET['question2']) && in_array('docs', $_GET['question2'])) {
    $q2Points = 5;
} else if (isset($_GET['question2']) && (in_array('music', $_GET['question2']) || in_array('social', $_GET['question2']))) {
    $q2Points = 1;
}

$q3Points = min(10, floor($q3Number / 10)); 

$totalScore = $q1Score + $q2Points + $q3Points + $q4Score + $q5Score;


$archetype = [
    'title' => 'The Debugger',
    'emoji' => '🧐',
    'description' => 'You rely on facts, use the debugger, and stick to the manual. Highly logical and thorough, you are the rock of any team. Your code is reliable, but you might over-optimize the "fast enough" parts.',
    'class' => 'smart'
];

if ($totalScore <= 12) {
    $archetype = [
        'title' => 'The Stack Overflow Scroller',
        'emoji' => '🚨',
        'description' => 'You prioritize speed over understanding, often posting your problems before tracing them. You\'re a fast-paced problem solver, but sometimes your solutions are held together with duct tape and a copy/paste from the internet. You love social media and background noise.',
        'class' => 'shy'
    ];
} elseif ($totalScore <= 22) {
    $archetype = [
        'title' => 'The Console Logger',
        'emoji' => '😎',
        'description' => 'You are a pragmatic, get-it-done coder. The debugger is too complex, but you’re methodical with your print statements. You know a few design patterns and keep your focus, but you are not above a little distraction while working.',
        'class' => 'cool'
    ];
} elseif ($totalScore <= 28) {
    $archetype = [
        'title' => 'The Efficiency Enthusiast',
        'emoji' => '🧠',
        'description' => 'You are dedicated to clean, efficient code and often spend time reading documentation. You appreciate good design patterns and have a strong desire to optimize things, even when they don\'t strictly need it. You are the academic of the group.',
        'class' => 'smart'
    ];
} else { // Score > 28
    $archetype = [
        'title' => 'The Go-Gopher Pragmatist',
        'emoji' => '🤪',
        'description' => 'You are a highly-focused, documentation-loving powerhouse who balances optimization with practicality. You use design patterns when needed, but your core style is simple and effective. You are the ultimate pro, but your range score shows a tendency to sometimes over-engineer.',
        'class' => 'chill'
    ];
}

$archetypes = [
    'shy' => [
        'title' => 'The Stack Overflow Scroller',
        'emoji' => '🚨',
        'description' => 'Fast-paced, high on external help, prone to distractions.'
    ],
    'cool' => [
        'title' => 'The Console Logger',
        'emoji' => '😎',
        'description' => 'Pragmatic, methodical with print statements, occasionally distracted.'
    ],
    'smart' => [
        'title' => 'The Efficiency Enthusiast',
        'emoji' => '🧠',
        'description' => 'Academic, loves documentation, prone to over-optimization.'
    ],
    'chill' => [
        'title' => 'The Go-Gopher Pragmatist',
        'emoji' => '🤪',
        'description' => 'Balanced, highly effective, simple and robust style.'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Lucas Espaladori">
    <title>Your Programmer Archetype</title>
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
                <h1>Quiz Results</h1>
            </div>
            <?php require_once 'nav.php'; ?>
        </header>

        <main class="main-content">
            <h2 style="text-align: center;">Hello, <?php echo $userName; ?>!</h2>
            <h3 style="text-align: center;">Your Programmer Archetype is: <span style="color: #007bff;"><?php echo $archetype['title']; ?></span></h3>
            
            <p style="text-align: center; font-size: 1.1em; padding: 10px; border: 1px dashed #ccc;">
                *Total Score: <?php echo $totalScore; ?> out of 35*
            </p>

            <div class="result-highlight-block">
                <div class="result-icon"><?php echo $archetype['emoji']; ?></div>
                <div class="result-text">
                    <h4>The <?php echo $archetype['title']; ?></h4>
                    <p><?php echo $archetype['description']; ?></p>
                </div>
            </div>
            
            <hr>
            
            <h3 style="text-align: center;">All Archetypes</h3>
            <p style="text-align: center; font-style: italic;">Find your highlighted category below!</p>

            <div class="archetype-grid">
                <?php foreach ($archetypes as $class => $data): ?>
                    <div class="archetype-card <?php echo ($class === $archetype['class']) ? 'highlighted' : ''; ?>">
                        <div class="card-icon <?php echo $class; ?>"><?php echo $data['emoji']; ?></div>
                        <h4 class="card-title"><?php echo $data['title']; ?></h4>
                        <p class="card-description"><?php echo $data['description']; ?></p>
                        <?php if ($class === $archetype['class']): ?>
                            <div class="you-are-here">⭐ YOU ARE HERE ⭐</div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

        </main>

        <hr>

        <?php require_once 'footer.php'; ?>

    </div>
</body>
</html>