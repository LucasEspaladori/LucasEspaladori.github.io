<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Lucas Espaladori">
    <title>About Me & My Interests</title>
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

        <h1>Welcome to My Website</h1>

        </div>

    <?php require_once 'nav.php'; ?>

</header>

        <div>
            <h2>About Lucas Espaladori</h2>
            <p>
                Hello! My name is Lucas Espaladori, and I'm a computer engineering student at the University of Ribeirão Preto(UNAERP). I am originally from Brazil.
                My journey into programming started when I discovered the endless possibilities of creating something from nothing.
            </p>

            <hr>
            
            <h2>My Interests Slideshow</h2>

            <div class="slideshow">
                
                <div class="slideshow_img">
                    <img src="https://media.istockphoto.com/id/1306372614/photo/best-homemade-pasta-is-done.jpg?s=612x612&w=0&k=20&c=AFLGFA2bbL-9bnGvqf75iPUNtYCwSqIBG5ByAYl4RGY=" alt="Image of a chef cooking." title="Cooking">
                </div>
                
                <div class="slideshow_img">
                    <img src="https://media.istockphoto.com/id/1356364268/photo/close-up-focus-on-persons-hands-typing-on-the-desktop-computer-keyboard-screens-show-coding.jpg?s=612x612&w=0&k=20&c=4R_9mWq9KzgpC_pVBMMM0FNzw1L-NyFLa7tDqFInMGs=" alt="Image of code on a computer screen." title="Programming Languages">
                </div>
                
                <div class="slideshow_img">
                    <img src="https://media.istockphoto.com/id/1482455750/photo/gamer-playing-driving-game-with-game-controller-in-neon-game-room.jpg?s=612x612&w=0&k=20&c=Zv9I4OcZwpn6gu9LehDi29onQ87_I4_2cDciriAEkuw=" alt="Image of a racing game perspective." title="Video Games">
                </div>
                
                <a class="prev" id="prev_link" onclick="previous()">&#10094; Previous</a>
                <a class="next" id="next_link" onclick="next()">Next &#10095;</a>

            </div>
            <hr>

            <h2>My Interests</h2>
            <p>Here are some things I love: <a href="https://github.com/LucasEspaladori/LucasEspaladori.github.io.git" target="_blank">My GitHub</a> </p>
            
            <ul>
                <li>Watching cooking &amp; comedy shows</li>
                <li>Learning about new programming languages</li>
                <li>Playing video games, especially FPS games</li>
            </ul>

            <h2>My Academic Journey</h2>
            <p>Here is a table listing my degrees and schools:</p>

            <table border="1" style="background-color: black; width: 100%;">
                <thead>
                    <tr style="background-color: cornflowerblue; font-family: 'Times New Roman', Times, serif; text-align: center;">
                        <th>Years</th>
                        <th>School / University</th>
                        <th>Field of Study</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="background-color: cornflowerblue; font-family: 'Times New Roman', Times, serif; text-align: center;">2010 - 2018</td>
                        <td style="background-color: greenyellow; font-family: 'Times New Roman', Times, serif; text-align: center;">Escola Moppe</td>
                        <td style="background-color: greenyellow; font-family: 'Times New Roman', Times, serif; text-align: center;"> Elementary school</td>
                    </tr>
                    <tr>
                        <td style="background-color: cornflowerblue; font-family: 'Times New Roman', Times, serif; text-align: center;">2018 - 2020</td>
                        <td style="background-color: greenyellow; font-family: 'Times New Roman', Times, serif; text-align: center;">Colegio Marista</td>
                        <td style="background-color: greenyellow; font-family: 'Times New Roman', Times, serif; text-align: center;">High School</td>
                    </tr>
                    <tr>
                        <td style="background-color: cornflowerblue; font-family: 'Times New Roman', Times, serif; text-align: center;">2021 - Present</td>
                        <td style="background-color: greenyellow; font-family: 'Times New Roman', Times, serif; text-align: center;">Universidade de Ribeirao Preto</td>
                        <td style="background-color: greenyellow; font-family: 'Times New Roman', Times, serif; text-align: center;">Computer Engineering</td>
                    </tr>
                    <tr>
                        <td style="background-color: cornflowerblue; font-family: 'Times New Roman', Times, serif; text-align: center;">2025 - 2025</td>
                        <td style="background-color: greenyellow; font-family: 'Times New Roman', Times, serif; text-align: center;">Bishops University</td>
                        <td style="background-color: greenyellow; font-family: 'Times New Roman', Times, serif; text-align: center;">Computer Science</td>
                    </tr>
                </tbody>
            </table>

            <br>

        </div>

        <hr>

        <?php require_once 'footer.php'; ?>

    <script>
        let current_slide = 0; 
        
        showSlide(current_slide); 

        function showSlide(n) {
            const slides = document.getElementsByClassName("slideshow_img");
            
            if (n >= slides.length) {
                current_slide = 0;
            }
            if (n < 0) {
                current_slide = slides.length - 1;
            }
            
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            
            slides[current_slide].style.display = "block";
        }

        function next() {
            current_slide++; 
            showSlide(current_slide);
        }

        function previous() {
            current_slide--;
            showSlide(current_slide);
        }
    </script>

    </body>
</html>
