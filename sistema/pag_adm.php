<?php
session_start();

$id_tatuador = $_GET['id'];

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // se o usuário não estiver logado vai para a página de login
    header("Location: login_adm.html");
    exit;
}
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // se o id nao estiver disponivel
    header("Location: erro.html");
    exit;
}

$id = $_GET['id'];

// Armazenar o ID do tatuador na sessão
$_SESSION['id'] = $id;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
        <link rel="icon" href="src/icon.png" type="image/png">
        <script src="script.js"></script>
        <title>Administração | SeivaBrutaTattoo</title>
    </head>
    <body>
        <ul class="pag_adm">
            <li><a href="cad_adm.html">Cadastrar Tatuador</a></li>
            <li><a href="edt_perfil.php">Editar Perfil</a></li>
            <li><a href="visualizar_orcamentos.php?id=<?php echo $id_tatuador; ?>">Verificar Orçamentos</a></li>
            <li><a href="avaliacao.php">Avaliações</a></li>
            <li><a href="edt_port.php">Portfolio</a></li><!--nao foi implementado-->
            <li><a href="logout.php">LOGOUT</a></li>
        </ul>
    </body>
</html>