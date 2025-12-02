<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Lucas Espaladori">
    <title>My Personal Art</title>
    <link rel="stylesheet" href="my_style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        /* * REQUISITO DO EXERCÍCIO: 
         * Estilos específicos da imagem e palavras-chave estão aqui.
         */
        
        .image-container {
            position: relative;
            display: block; /* Mude para block */
            max-width: 900px; /* Defina uma largura máxima */
            margin: 20px auto; /* Centraliza o elemento de bloco horizontalmente */
            text-align: center; /* (Opcional, mas ajuda) */
        }
        
        /* Estilo para a imagem dentro do container */
        .image-container img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .keyword {
            position: absolute;
            font-weight: bold;
            font-size: 1.5em;
            text-shadow: 2px 2px 4px black;
        }
        
        /* Posição das Palavras-chave */
        #keyword1 {
            color: grey;
            top: 25%;
            left: 25%;
            transform: rotate(-10deg);
        }
        #keyword2 {
            color: purple;
            top: 15%;
            right: 35%;
            transform: rotate(15deg);
        }
        #keyword3 {
            color: black;
            top: 45%;
            left: 70%;
            transform: rotate(-5deg);
        }
        #keyword4 {
            color: brown;
            top: 55%;
            left: 30%;
            transform: rotate(25deg);
        }
        #keyword5 {
            color: black;
            bottom: 10%;
            left: 50%;
            transform: translateX(-50%) rotate(-10deg);
        }
        
        .description {
            text-align: justify;
            line-height: 1.6;
            margin-bottom: 20px;
            /* Centraliza a descrição no main-content */
            max-width: 800px; 
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <div class="body_wrapper"> 
        
        <header>
            <div class="title-container">
                <a href="index.php" class="header-icon-link">
                    <img src="https://cdn-icons-png.flaticon.com/512/5339/5339181.png" alt="Website Icon" class="header-icon">
                </a>
                <h1>My art style</h1>
            </div>
            
            <?php require_once 'nav.php'; ?>
        </header>

        <main class="main-content">

            <div class="image-container">
                <img src="https://media.istockphoto.com/id/1805828348/vector/sketch-math-symbols-equations-and-formulas-and-graphics-hand-written-doodles-vector.jpg?s=612x612&w=0&k=20&c=6aeaANMR0N1oM79KrZQw98u_1TGlN8I3iP-lSWGc-8c=" alt="Mathematical Doodles and Keywords">
                <span class="keyword" id="keyword1">Creative</span>
                <span class="keyword" id="keyword2">Analytical</span>
                <span class="keyword" id="keyword3">Adaptive</span>
                <span class="keyword" id="keyword4">Helpful</span>
                <span class="keyword" id="keyword5">Intriguing</span>
            </div>

            <p class="description">
                This image represents a blend of analytical and creative thinking, as depicted by the mathematical equations alongside geometric shapes and artistic text. The keywords "Helpful," "Adaptive," and "Intriguing" are integrated, reflecting the desire to offer beneficial and flexible solutions that spark curiosity, all within a visually engaging context.
            </p>
        
        </main>

        <hr>
        <?php require_once 'footer.php'; ?>
    </div>
</body>
</html>