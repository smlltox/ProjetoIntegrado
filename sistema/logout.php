<?php
session_start(); 

// Encerra a sessão destruindo todas as variáveis de sessão
session_unset();
session_destroy();

// Redireciona o usuário para a página de login após o logout
header("Location: login.html");
exit;
?>
