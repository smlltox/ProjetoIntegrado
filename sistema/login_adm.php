<?php
session_start(); // inicia sessão para verificar se o usuario está logado para acessar determinadas páginas

// conexão com o PostgreSQL
$host = "localhost";
$dbname = "postgres";
$user = "postgres";
$password = "postgres";

$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

if ($_SERVER["REQUEST_METHOD"] === "POST") { // a requisição é um POST
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // query tatuador
    $stmt = $pdo->prepare("SELECT * FROM tatuador WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario["senha"])) {
        $_SESSION['logged_in'] = true;// verifica se o usuario está logado para acessar determinadas páginas
        $id = $usuario["id"];
        header("Location: pag_adm.php?id=" . $id);
        exit;
    } else {
        header("Location: erro.html");
        exit;
    }
} else { // se não for um POST
    header("Location: erro.html");
    exit;
}

?>