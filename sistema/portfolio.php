<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // se o usuário não estiver autenticado vai para a página de login
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
        <script src="script.js"></script>
        <link rel="icon" href="src/icon.png" type="image/png">
        <title>Portfolios | SeivaBrutaTattoo</title>
    </head>
    <body>
        <div class="port">
            <button class="portp" onclick="mostrarLista()">
                <img class="perfil" src="src/pessoa.png">
            </button>
            <button class="portp" onclick="mostrarLista2()">
                <img class="perfil" src="src/pessoa.png">
            </button>
            <ul id="minhaLista" style="display:none;">  
                <img class="portfolio" src="src/addimg.png">
                <img class="portfolio" src="src/addimg.png">
                <img class="portfolio" src="src/addimg.png">
                <img class="portfolio" src="src/addimg.png">
                <img class="portfolio" src="src/addimg.png">
                <img class="portfolio" src="src/addimg.png">
                <img class="portfolio" src="src/addimg.png">
                <img class="portfolio" src="src/addimg.png">
                <img class="portfolio" src="src/addimg.png">
                <img class="portfolio" src="src/addimg.png">
                <img class="portfolio" src="src/addimg.png">
                <img class="portfolio" src="src/addimg.png">
                <button class="adminButton" style="display:none;">Editar portfolio</button>
            </ul>
            <ul id="minhaLista2" style="display:none;">  
                <img class="portfolio" src="src/addimg.png">
                <img class="portfolio" src="src/addimg.png">
                <img class="portfolio" src="src/error.png">
                <img class="portfolio" src="src/addimg.png">
                <img class="portfolio" src="src/addimg.png">
                <img class="portfolio" src="src/addimg.png">
                <img class="portfolio" src="src/addimg.png">
                <img class="portfolio" src="src/addimg.png">
                <img class="portfolio" src="src/addimg.png">
                <img class="portfolio" src="src/addimg.png">
                <img class="portfolio" src="src/addimg.png">
                <img class="portfolio" src="src/addimg.png">
                <button class="adminButton" style="display:none;">Editar portfolio</button>
            </ul>
        </div>    
        
        <nav>
            <ul>
                <li id="logo"><a href="index.php"><img src="src/icon.png"></a></li>
                <li><a href="logout.php">LOGOUT</a></li>
                <li><a href="orçamentos.html">SOLICITAR ORÇAMENTO</a></li>
                <li><a href="portfolio.php">PORTFÓLIO</a></li>
            </ul>
        </nav>
    </body>
</html>