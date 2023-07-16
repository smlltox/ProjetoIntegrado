<?php
session_start(); // inicia sessão para verificar se o usuario está logado para acessar determinadas páginas
// conexão com o PostgreSQL
$host = "localhost";
$dbname = "postgres";
$user = "postgres";
$password = "postgres";

$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

if ($_SERVER["REQUEST_METHOD"] === "POST") { // a requisição é um POST
    // dados enviados pelo formulário
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // consultando o banco de dados para obter os dados do usuário com base no email
    $stmt = $pdo->prepare("SELECT * FROM tatuador WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario["senha"])) {
        $_SESSION['logged_in'] = true;// isso é para verificar se o usuario está logado para acessar determinadas páginas
        header("Location: pag_adm.php");
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