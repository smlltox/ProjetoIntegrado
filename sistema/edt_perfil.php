<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login_adm.html");
    exit;
}

// Verifica se o ID do tatuador está disponível na sessão
if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    header("Location: erro.html");
    exit;
}

// Conexão com o PostgreSQL
$host = "localhost";
$dbname = "postgres";
$user = "postgres";
$password = "postgres";

$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

// Verificando se é um POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtendo os dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $descr = $_POST["descr"];
    $telefone = $_POST["telf"];
    $ftperfil = $_POST["ftperfil"];

    // Verifica se a senha foi alterada e faz o hash
    $senhaHash = $senha ? password_hash($senha, PASSWORD_DEFAULT) : null;

    // Query de atualização
    $id = $_SESSION['id']; // Obtém o ID do tatuador da sessão
    $stmt = $pdo->prepare("UPDATE tatuador SET nome = ?, email = ?, senha = ?, descr = ?, telf = ?, ftperfil = ? WHERE id = ?");
    $stmt->execute([$nome, $email, $senhaHash, $descr, $telefone, $ftperfil, $id]);

    // Verifica se a atualização deu certo
    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Perfil atualizado com sucesso!');
        window.location.href = 'pag_adm.php" . $id . "';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar o perfil. Tente novamente.');</script>";
    }
}

// Obtém os dados atuais do tatuador do banco de dados para preencher o formulário
$id = $_SESSION['id'];
$stmt = $pdo->prepare("SELECT * FROM tatuador WHERE id = ?");
$stmt->execute([$id]);
$tatuador = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css" media="screen">
    <link rel="icon" href="src/icon.png" type="image/png">
    <script src="script.js"></script>
    <title>Editar Perfil | SeivaBrutaTattoo</title>
</head>
<body>
    <div class="login-screen">
        <img src="src/icon.png">
        <h1>Editar Perfil:</h1>
        <form action="editar_perfil.php" method="post">
            <input class="input" placeholder="Nome Completo" name="nome" value="<?php echo $tatuador['nome']; ?>" required>
            <input class="input" placeholder="Telefone" name="telf" value="<?php echo $tatuador['telf']; ?>" required>
            <input class="input" placeholder="Breve descrição" name="descr" value="<?php echo $tatuador['descr']; ?>" required>
            <input class="input" placeholder="Foto de Perfil" name="ftperfil" value="<?php echo $tatuador['ftperfil']; ?>" required>
            <input class="input" type="password" placeholder="Nova Senha (deixe em branco para manter a senha atual)" name="senha" required>
            <input class="submit" type="submit" value="Atualizar Perfil">
        </form>
    </div>
</body>
</html>
