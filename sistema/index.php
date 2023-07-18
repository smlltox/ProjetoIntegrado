<!--verifica se usuario está logado-->
<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // se o usuário não estiver autenticado vai para a página de login
    header("Location: login.html");
    exit;
}

$id_user = $_GET['id'];

// Conexão com o PostgreSQL    
    $host = "localhost";
    $dbname = "postgres";
    $user = "postgres";
    $password = "postgres";

    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

    
//INSERE AVALIAÇÃO NO BANCO

// se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $estrelas = $_POST["estrelas"]; 
    $avaliacao = $_POST["descr"];
    
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id_user = $_GET['id'];

        $cliente = $_SESSION['id']; // Obtem o ID do cliente da sessão

        //query
        $stmt = $pdo->prepare("INSERT INTO avaliacao (estrelas, descr, dta, cliente) VALUES (?, ?, CURRENT_DATE, ?)");
        $stmt->execute([$estrelas, $avaliacao, $cliente]); 

        // se a inserção deu certo
        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Avaliação adicionada com sucesso!');
            window.location.href = 'index.php?id=" . $id_user . "';</script>";
        } else {
            echo "<script>alert('Erro ao adicionar a avaliação. Tente novamente.');</script>";
        }
    }
}

// ADICIONA AVALIAÇÃO NA PAGINA

// Query para obter avaliação
$stmt = $pdo->prepare("SELECT nome, descr, estrelas FROM usuarios JOIN avaliacao ON usuarios.id = avaliacao.cliente WHERE usuarios.id = ?");
$stmt->execute([$id_user]);
$avaliacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Armazenar o ID do usuário na sessão
$_SESSION['id'] = $id_user;
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
            <?php
                // Query para obter nome foto e descrição dos tatuadores
                $stmt_todos_tatuadores = $pdo->query("SELECT nome, descr, ftperfil FROM tatuador");
                $todos_tatuadores = $stmt_todos_tatuadores->fetchAll(PDO::FETCH_ASSOC);

                foreach ($todos_tatuadores as $tatuadores) {
                    echo '<div class="item">';
                    echo '<img class="tatuador" src="src/pessoa.png" alt="Foto 1">';
                    echo '<div class="content">';
                    echo '<h2>' . $tatuadores['nome'] .'</h2>';
                    echo '<p>' . $tatuadores['descr'] .'</p>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
            <div class="avaliacoes">
                <?php
                // Query para obter todas as avaliações
                $stmt_todas_avaliacoes = $pdo->query("SELECT nome, descr, estrelas FROM usuarios JOIN avaliacao ON usuarios.id = avaliacao.cliente");
                $todas_avaliacoes = $stmt_todas_avaliacoes->fetchAll(PDO::FETCH_ASSOC);

                foreach ($todas_avaliacoes as $avaliacao) {
                    echo '<div class="info">';
                    echo '<img id="foto_aval" src="src/foto.jpg">';
                    echo '<div class="aval">';
                    echo '<h3>' . $avaliacao['nome'] . '</h3>';
                    echo '<p>' . $avaliacao['estrelas'] . '</p>';
                    echo '<p>' . $avaliacao['descr'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
                <form action="index.php?id=<?php echo $id_user; ?>" method="POST">
                    <input class="star" type="number" name="estrelas" placeholder="estrelas" min="1" max="5">
                    <input class="input" type="text" name="descr" placeholder="Deixe sua avaliação...">
                    <input class="submit" type="submit" value="Avaliar">
                </form>
            </div>
        </div>

        <!--MENU-->
        
        <nav>
            <ul>
                <li id="logo"><a href="index.php"><img src="src/icon.png"></a></li>
                <li><a href="logout.php">LOGOUT</a></li>
                <li><a href="orcamentos.php?id=<?php echo $id_user; ?>">ORÇAMENTOS</a></li>
                <li><a href="portfolio.php">PORTFÓLIOS</a></li>
            </ul>
        </nav>
    </body>
</html>