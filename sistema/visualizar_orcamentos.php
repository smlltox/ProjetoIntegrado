<?php
session_start();

$id_user = $_SESSION['id'];

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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["preco"]) && isset($_POST["id_orcamento"])) {
        $preco = $_POST["preco"];
        $id_orcamento = $_POST["id_orcamento"];
    
        // Insert o preço na tabela "orcamentos"
        $stmt_insert = $pdo->prepare("UPDATE orcamentos SET preco = :preco, aprovado = true WHERE id = :id_orcamento AND tt_desejado = :id_user AND aprovado = false");
        $stmt_insert->bindParam(":preco", $preco); //consultas preparadas, por isso tem :
        $stmt_insert->bindParam(":id_orcamento", $id_orcamento);
        $stmt_insert->bindParam(":id_user", $id_user);
    
        if ($stmt_insert->execute()) {
            echo "<script>alert('Orçamento Aprovado');
        window.location.href = 'visualizar_orcamentos.php';</script>";
        } else {
            echo "<script>alert('Erro ao aprovar orçamento. Tente novamente.');</script>";
        }
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
        <title>Aprovar Orcamentos | SeivaBrutaTattoo</title>
    </head>
    <body>
        <div class="login-screen" id="pend">
            <h1>Orçamentos pendentes:</h1>
            <div class="orcs">
                <?php
                // Query para obter todos os orçamentos pendentes que possuam tt_desejado = $id_user 
                $stmt = $pdo->prepare("
                    SELECT o.*, u.nome AS nome_cliente
                    FROM orcamentos o
                    JOIN usuarios u ON o.cliente = u.id
                    WHERE o.aprovado = false AND o.tt_desejado = :id
                "); 
                $stmt->bindParam(":id", $id_user);
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="pend">';
                    echo '<h2>' . $row['nome_cliente'] . '</h2>';
                    echo '<p>Data: ' . $row['data_solc'] . '</p>';
                    echo '<p>Tamanho: ' . $row['tamanho'] . '</p>';
                    echo '<p>Local: ' . $row['local_corpo'] . '</p>';
                    if ($row['descr'] !== null) { //se descr for null
                        echo '<p>Descrição: ' . $row['descr'] . '</p>';
                    }
                    echo '<form action="visualizar_orcamentos.php" method="POST">';
                    echo '<input type="hidden" name="id_orcamento" value="' . $row['id'] . '">'; // campo oculto para enviar o ID do orçamento
                    echo '<input style="width: 60%;" class="input" type="text" name="preco" placeholder="Valor:">';
                    echo '<input style="width: 60%;" class="submit" type="submit" placeholder="Enviar">';
                    echo '</form>';
                    echo '</div>';
                }
                ?>
            </div>
            <h1>Orçamentos aprovados:</h1>
            <div class="orcs">
                <?php
                // Query para obter todos os orçamentos aprovados que possuam tt_desejado = $id_user
                $stmt = $pdo->prepare("
                    SELECT o.*, u.nome AS nome_cliente
                    FROM orcamentos o
                    JOIN usuarios u ON o.cliente = u.id
                    WHERE o.aprovado = true AND o.tt_desejado = :id
                "); 
                $stmt->bindParam(":id", $id_user);
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="pend">';
                    echo '<h2>' . $row['nome_cliente'] . '</h2>';
                    echo '<p>Data: ' . $row['data_solc'] . '</p>';
                    echo '<p>Tamanho: ' . $row['tamanho'] . 'cm</p>';
                    echo '<p>Local: ' . $row['local_corpo'] . '</p>';
                    if ($row['descr'] !== null) { //se descr for null
                        echo '<p>Descrição: ' . $row['descr'] . '</p>';
                    }
                    echo '<h2 style="color:red;">Valor: R$' . $row['preco'] . '</h2>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </body>
</html>