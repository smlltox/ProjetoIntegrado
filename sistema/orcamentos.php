<?php
session_start();

$id_user = $_GET['id'];//pega id enviada do index

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // se o usuário não estiver autenticado vai para a página de login
    header("Location: login.html");
    exit;
}

// Conexão com o PostgreSQL    
    $host = "localhost";
    $dbname = "postgres";
    $user = "postgres";
    $password = "postgres";

    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

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
        <title>Visualizar Orcamento | SeivaBrutaTattoo</title>
    </head>
    <body>
        <button class="sctor"><a href="solct_orcamento.php?id=<?php echo $id_user; ?>">Solicitar Orçamento</a></button>
        <p></p>
        <div class="login-screen" id="pend">
            <h1>Orçamentos:</h1>
            <div class="orcs">
                <?php
                // Query para obter orçamentos
                $stmt_orcApd = $pdo->query("
                    SELECT u.nome AS nome_cliente, t.nome AS nome_tatuador, t.telf AS telf, o.tamanho, o.local_corpo, o.descr, o.referencia1, o.preco
                    FROM orcamentos o
                    JOIN usuarios u ON o.cliente = u.id
                    JOIN tatuador t ON o.tt_desejado = t.id
                    WHERE o.aprovado = true
                ");
                $orcApd = $stmt_orcApd->fetchAll(PDO::FETCH_ASSOC);

                // Exibindo informações do orçamento aprovado + contato e valor estipulado pelo tatuador
                foreach ($orcApd as $orcs) {
                    echo '<div class="pend">';
                    echo '<h2>' . $orcs['nome_cliente'] . '</h2>';
                    echo '<p>Tamanho: ' . $orcs['tamanho'] . 'cm</p>';
                    echo '<p>Local: ' . $orcs['local_corpo'] . '</p>';
                    if ($orcs['descr'] !== null) { //se descr for null
                        echo '<p>Descrição: ' . $orcs['descr'] . '</p>';
                    }
                    echo '<h2>' . $orcs['nome_tatuador'] . '</h2>';
                    echo '<h2>Contato: ' . $orcs['telf'] . '</h2>';
                    echo '<h2 style="color:red;">Valor: R$' . $orcs['preco'] . '</h2>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
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