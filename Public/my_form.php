<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Lucas Espaladori">
    <title>Programmer Personality Quiz</title>
    <link rel="stylesheet" href="my_style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="my_form.js"></script> </head>

<body>
    <div class="body_wrapper">

        <header>
            <div class="title-container">

                <a href="index.php" class="header-icon-link">
                 <img src="https://cdn-icons-png.flaticon.com/512/5339/5339181.png" alt="Website Icon" class="header-icon">
                </a>

        <h1>Quiz</h1>

        </div>

    <?php require_once 'nav.php'; ?>

</header>

        <main class="main-content">
            <p class="intro-text">Answer the questions below to find out your true programmer archetype. Don't worry, there's no right or wrong answer—just code!</p>
            
            <form action="quiz_verification.php" method="GET" class="programmer-quiz-form" onsubmit="return validate(event)">
                <fieldset>
                    <legend>The Programmer Archetype Quiz</legend>

                    <div class="form-group required">
                        <label for="user_name">Your Name:</label>
                        <input type="text" id="user_name" name="user_name" required placeholder="Enter your full name">
                    </div>

                    <div class="form-group required">
                        <label for="user_email">Your Email:</label>
                        <input type="email" id="user_email" name="user_email" required placeholder="email@example.com">
                    </div>
                    
                    <hr>

                    <div class="form-group question-block">
                        <label><strong>1. When fixing a deeply nested bug, your first action is:</strong></label>
                        <div class="radio-options">
                            <input type="radio" id="q1_a" name="question1" value="1" required>
                            <label for="q1_a">A) Immediately post the entire function on Stack Overflow. (1 point)</label><br>
                            
                            <input type="radio" id="q1_b" name="question1" value="3">
                            <label for="q1_b">B) Add a million `console.log()` statements to trace variable states. (3 points)</label><br>
                            
                            <input type="radio" id="q1_c" name="question1" value="5">
                            <label for="q1_c">C) Read the error message, trace the stack, and use the debugger. (5 points)</label>
                        </div>
                    </div>

                    <div class="form-group question-block">
                        <label><strong>2. Which tools are open right now (select all that apply):</strong></label>
                        <div class="checkbox-options">
                            <input type="checkbox" id="q2_a" name="question2[]" value="music">
                            <label for="q2_a">Music/Podcast (Need background noise)</label><br>
                            
                            <input type="checkbox" id="q2_b" name="question2[]" value="social">
                            <label for="q2_b">Social Media (Just checking *one* thing)</label><br>
                            
                            <input type="checkbox" id="q2_c" name="question2[]" value="docs">
                            <label for="q2_c">Official Language Docs (RTFM is life)</label>
                        </div>
                    </div>

                    <div class="form-group question-block">
                        <label for="q3_number"><strong>3. How many times have you *actually* used a design pattern (like Singleton or Factory) this month?</strong></label>
                        <input type="number" id="q3_number" name="question3" min="0" max="100" value="0" placeholder="0-100">
                    </div>

                    <div class="form-group question-block">
                        <label for="q4_select"><strong>4. Which language's mascot best describes your personal style?</strong></label>
                        <select id="q4_select" name="question4" required>
                            <option value="" disabled selected>Choose a Mascot...</option>
                            <option value="1">Python Snake (Elegant, focused) (1 point)</option>
                            <option value="3">Java Coffee Cup (Reliable, high-energy) (3 points)</option>
                            <option value="5">Go Gopher (Practical, simple) (5 points)</option>
                        </select>
                    </div>

                    <div class="form-group question-block">
                        <label for="q5_range"><strong>5. On a scale of 1 to 10, how likely are you to optimize code that already runs "fast enough"?</strong> <span id="range_value">(5)</span></label>
                        <input type="range" id="q5_range" name="question5" min="1" max="10" value="5" oninput="document.getElementById('range_value').textContent = this.value">
                    </div>
                    
                    <div class="form-group">
                        <button type="submit">Submit My Answers & Find My Archetype</button>
                    </div>

</fieldset>
            </form>

        </main>

        <hr>

        <?php require_once 'footer.php'; ?>

    </div>
</body>
</html>