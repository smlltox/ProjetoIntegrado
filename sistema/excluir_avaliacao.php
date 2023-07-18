<?php
// Verifica se o ID da avaliação foi fornecido via POST
if (isset($_POST['ida'])) {
    // Conexão com o PostgreSQL
    $host = "localhost";
    $dbname = "postgres";
    $user = "postgres";
    $password = "postgres";

    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

    $id_avaliacao = $_POST['ida'];
    echo $id_avaliacao;
    // delete
    $stmt = $pdo->prepare("DELETE FROM avaliacao WHERE ida = ?");
    if ($stmt->execute([$id_avaliacao])) {
        echo "Avaliação excluída com sucesso!";
    } else {
        echo "Erro ao excluir a avaliação.";
    }
}
?>
