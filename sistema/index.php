<!--verifica se usuario está logado-->
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
        <link rel="icon" href="src/icon.png" type="image/png">
        <script src="script.js"></script>
        <script src="script.js"></script>
        <title>SeivaBrutaTattoo</title>
    </head>
    <body>
        <div id="inicial">
            
        <!--menu para celulares-->
        <button class="menuzito"><a href="menu.html"><img src="src/menu.png"></img></a></button>


            <img class="temp" src="src/template.jpg">
            <div id="galeria">
                <img src="src/adddimg.png" alt="Imagem 1">
                <img src="src/adddimg.png" alt="Imagem 2">
                <img src="src/adddimg.png" alt="Imagem 3">
                <img src="src/adddimg.png" alt="Imagem 4">
                <img src="src/adddimg.png" alt="Imagem 5">
                <img src="src/adddimg.png" alt="Imagem 6">
                <img src="src/adddimg.png" alt="Imagem 7">
                <img src="src/adddimg.png" alt="Imagem 8">
                <img src="src/adddimg.png" alt="Imagem 9">
                <img src="src/adddimg.png" alt="Imagem 10">
            </div>

            <div class="container">
                <div class="item">
                  <img class="tatuador" src="src/pessoa.png" alt="Foto 1">
                  <div class="content">
                    <h2>Nome do tatuador</h2>
                    <p>Descrição s222 obre o tatuador ks jdhfjks bdj ahsgdhas dhagsdhasdg ajgfd fgbsgfsgbf bshufvhs jbfisbfibsifb sgfsdg fsgdhf sdugf sgdf sfgusd sdg fisdgifgsdiuf shfshf shjfoshjf shf h.</p>
                  </div>
                </div>
                <div class="item">
                    <img class="tatuador" src="src/pessoa.png" alt="Foto 2">
                    <div class="content">
                        <h2>Nome do tatuador</h2>
                        <p>Descrição sobre o tatuador.</p>
                    </div>
                </div>
            </div>
            <div class="avaliacoes">
                <h1 id="avl">Avaliações de clientes:</h1>
                <div class="avaliacao">
                    <img src="src/foto.jpg">
                    <div class="aval">
                        <h3>Nome avaliador</h3>
                        <p>Avaliação... sdjhf sfdb ushgf hsiuhg hsjdgahjsgd ajhsdghjgdf ja222 shdghjasgdf ajhsgdjashdg jhasgdhf jshdghfnf hgf sjkuytfbr sadf</p>
                    </div>
                </div>
                <div class="avaliacao">
                    <img src="src/foto.jpg">
                    <div class="aval">
                        <h3>Nome</h3>
                        <p>Avaliação... sdjhf sfdb ushgf hsiuhg hsjdgahjsgd ajhsdghjgdf ja222 shdghjasgdf ajhsgdjashdg jhasgdhf jshdghfnf hgf sjkuytfbr sadf</p>
                    </div>
                </div>
                <input class="input" type="text" placeholder="Deixe sua avaliação...">
                <input class="submit" type="submit" value="Avaliar">
            </div>
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