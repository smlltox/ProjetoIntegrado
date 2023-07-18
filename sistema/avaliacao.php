<?php
session_start();


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
        <title>Avaliações | SeivaBrutaTattoo</title>
    </head>
    <body>
        <div id="inicial">
            <div class="avaliacoes">
                <h1 style="color: white">AVALIAÇÕES:</h1>
                <?php
                // Query para obter todas as avaliações
                $stmt_todas_avaliacoes = $pdo->query("SELECT ida, nome, descr, estrelas FROM usuarios JOIN avaliacao ON usuarios.id = avaliacao.cliente");
                $todas_avaliacoes = $stmt_todas_avaliacoes->fetchAll(PDO::FETCH_ASSOC);

                // Exibindo todas as avaliações
                foreach ($todas_avaliacoes as $avaliacao) {
                    echo '<div class="info">';
                    echo '<img id="foto_aval" src="src/foto.jpg">';
                    echo '<div class="aval">';
                    echo '<h3>' . $avaliacao['nome'] . '</h3>';
                    echo '<p>' . $avaliacao['estrelas'] . '</p>';
                    echo '<p>' . $avaliacao['descr'] . '</p>';
                    echo '</div>';
                    echo '<a onclick="excluirAvaliacao(' . $avaliacao['ida'] . ')">';
                    echo '<img id="foto_aval" src="src/lixo.png" style="cursor: pointer;">';
                    echo '</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
        <script>
            function excluirAvaliacao(ida) {
                console.log("ID da avaliação a ser excluída:", ida);
                if (confirm("Tem certeza de que deseja excluir essa avaliação?")) {
                    // com AJAX
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                console.log(xhr.responseText);
                                window.location.reload(); //recarregar
                            } else {
                                console.error('Erro ao excluir a avaliação.');
                            }
                        }
                    };
                    xhr.open('POST', 'excluir_avaliacao.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.send('ida=' + encodeURIComponent(ida));
                }else {
                    console.log("Exclusão cancelada pelo usuário.");
                }
            }
        </script>
    </body>
</html>