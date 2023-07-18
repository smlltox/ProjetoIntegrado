<?php
session_start();
$id = $_SESSION['id']; //pega a id enviada pelo endereço

// logado
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


// dados do tatuador 
$stmt = $pdo->prepare("SELECT * FROM tatuador WHERE id = ?");
$stmt->execute([$id]);
$tatuador = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificando se é um POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $descr = $_POST["descr"];
    $telefone = $_POST["telf"];
    $ftperfil = $_POST["ftperfil"];

    // Query de atualização
    $stmt = $pdo->prepare("UPDATE tatuador SET nome = ?, email = ?, senha = ?, descr = ?, telf = ?, ftperfil = ? WHERE id = ?");

    // hash
    if (!empty($_POST["senha_alterada"]) && !empty($_POST["senha"])) {
        $senha = $_POST["senha"];
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT); //hash 
    } else { // Se a senha não foi alterada mantem a senha atual 
        $senhaHash = $tatuador['senha'];
    }

    $stmt->execute([$nome, $email, $senhaHash, $descr, $telefone, $ftperfil, $id]); //guarda

    // se a atualização deu certo
    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Perfil atualizado com sucesso!');
         window.location.href = 'pag_adm.php?id=" . $id . "';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar o perfil. Tente novamente.');</script>";
    }
}

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
        <form action="edt_perfil.php" method="post">
            <input class="input" placeholder="Nome Completo" name="nome" value="<?php echo $tatuador['nome']; ?>" required>
            <input class="input" type="email" placeholder="E-mail" name="email" value="<?php echo $tatuador['email']; ?>" required>
            <input class="input" type="tel" id="telefone" placeholder="(XX) XXXXX-XXXX" name="telf" value="<?php echo $tatuador['telf']; ?>" required>
            <input class="input" placeholder="Breve descrição" name="descr" value="<?php echo $tatuador['descr']; ?>" required>
            <input class="input" placeholder="Foto de Perfil" name="ftperfil" value="<?php echo $tatuador['ftperfil']; ?>" required>
            <input class="input" type="password" placeholder="Nova Senha (deixe em branco para manter a senha atual)" name="senha">
            <input class="submit" type="submit" value="Atualizar Perfil">
        </form>
    </div>
    <script>
            // Função para formatar automaticamente o campo de telefone
            function formatarTelefone(input) {
                const value = input.value.replace(/\D/g, '');
                input.value = value.replace(/^(\d{2})(\d{5})(\d{4}).*/, '($1) $2-$3');
            }
    
            // Adiciona um evento de digitação ao campo de telefone
            const telefoneInput = document.getElementById('telefone');
            telefoneInput.addEventListener('input', function() {
                formatarTelefone(this);
            });
        </script>
</body>
</html>
