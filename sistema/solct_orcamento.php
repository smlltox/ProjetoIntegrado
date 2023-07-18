<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // se o usuário não estiver autenticado vai para a página de login
    header("Location: login.html");
    exit;
}

$id_user = $_GET['id'];

// conexão com o PostgreSQL
$host = "localhost";
$dbname = "postgres";
$user = "postgres";
$password = "postgres";

$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

// se é um POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tamanho = $_POST["tamanho"];
    $local_corpo = $_POST["local_corpo"];
    $descr = $_POST["descr"];
    $idt = $_POST["campo"];
    $referencia1 = $_POST["referencia1"];

    echo $id_user;

    $cliente = $id_user;

    // query de inserção
    $stmt = $pdo->prepare("INSERT INTO orcamentos (tamanho, local_corpo, descr, tt_desejado, referencia1, cliente, aprovado) VALUES (?, ?, ?, ?, ?, ?, false)");
    $stmt->execute([$tamanho, $local_corpo, $descr, $idt, $referencia1, $cliente]);

    // se a inserção deu certo
    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Cadastro realizado com sucesso!');
        window.location.href = 'orcamentos.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar. Tente novamente.');</script>";
    }
}

// Query para obter os tatuadores para o dropdown
$stmt_tatuadores = $pdo->query("SELECT id, nome FROM tatuador");
$tatuadores = $stmt_tatuadores->fetchAll(PDO::FETCH_ASSOC);

// Armazenar o ID do usuário na sessão
$_SESSION['id'] = $id_user;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
    <link rel="icon" href="src/icon.png" type="image/png">
    <script src="script.js"></script>
    <title>Solicitar Orcamento | SeivaBrutaTattoo</title>
</head>
<body>
    <div class="login-screen">
        <img src="src/icon.png">
        <h1>Solicite seu orçamento:</h1>
        <form action="solct_orcamento.php?id=<?php echo $id_user; ?>" method="POST">
            <input class="input" type="number" placeholder="Tamanho da tatuagem em cm" name="tamanho" required>
            <input class="input" type="text" placeholder="Local do corpo" name="local_corpo" required>
            <input class="input" type="text" placeholder="Descrição (opcional)" name="descr">
            <div class="form-dropdown">
                <select class="input" id="campo" name="campo" class="select-dropdown">
                <option>Selecione o tatuador:</option>
                    <?php
                    foreach ($tatuadores as $tatuador) {
                        echo '<option value="' . $tatuador['id'] . '">' . $tatuador['nome'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <input class="input" type="text" placeholder="referencia1" name="referencia1" required>
            <input class="submit" type="submit" value="Solicitar Orçamento">
        </form>
    </div>
    <nav>
        <ul>
            <li id="logo"><a href="index.php"><img src="src/icon.png"></a></li>
            <li><a href="logout.php">LOGOUT</a></li>
            <li><a href="orcamentos.html">ORÇAMENTOS</a></li>
            <li><a href="portfolio.php">PORTFÓLIOS</a></li>
        </ul>
    </nav>
</body>
</html>
