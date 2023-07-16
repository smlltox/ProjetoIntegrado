<!--verifica se usuario está logado-->
<?php
session_start();

$id_tatuador = $_GET['id'];

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // se o usuário não estiver autenticado vai para a página de login
    header("Location: login_adm.html");
    exit;
}
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Se o ID do tatuador não estiver disponível, redireciona para uma página de erro ou outra página adequada
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
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
        <link rel="icon" href="src/icon.png" type="image/png">
        <title>Administração | SeivaBrutaTattoo</title>
    </head>
    <body>
        <ul class="pag_adm">
            <li><a href="edt_port.php">Editar Portfolio</a></li>!!!!!!!!!!!!
            <li><a href="edt_perfil.php">Editar Perfil</a></li>!!!!!!!!!!!
            <li><a href="visualizar_orçamentos.html">Verificar Orçamentos</a></li>
            <li><a href="rmv_avl.html">Remover Avaliações</a></li>!!!!!!!
            <li><a href="cad_adm.html">Cadastrar Tatuador</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
        </ul>
    </body>
</html>