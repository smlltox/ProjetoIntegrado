<?php
try{  
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
        $telefone = $_POST["telf"];

        // cria o hash
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        // query de inserção
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, telf) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $email, $senhaHash, $telefone]);

        // se a inserção deu certo
        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Cadastro realizado com sucesso!');
            window.location.href = 'login.html';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar. Tente novamente.');</script>";
        }
    }
} catch (PDOException $e) { //  email duplicado
    echo '<script>alert("O email já está cadastrado.");</script>';
    echo '<script>window.location.href = "cadastrar.html";</script>';
    exit(); 
}
?>
