<?php
// conexão com o PostgreSQL
$host = "localhost";
$dbname = "postgres";
$user = "postgres";
$password = "postgres";

$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

// verificando se é um POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // obtendo os dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $descr = $_POST["descr"];
    $telefone = $_POST["telf"];
    $ftperfil = $_POST["ftperfil"];

    // hash
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // query de inserção
    $stmt = $pdo->prepare("INSERT INTO tatuador (nome, email, senha, descr, telf, ftperfil) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nome, $email, $senhaHash, $descr, $telefone, $ftperfil]);

    // se a inserção deu certo
    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Cadastro realizado com sucesso!');
        window.location.href = 'login.html';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar. Tente novamente.');</script>";
    }
}
?>