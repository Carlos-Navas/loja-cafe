<?php
session_start();

// Verifica se usuário está logado
if (isset($_SESSION['usuario_id'])) {
    // Já logado → vai para pagamento
    header("Location: processa_checkout.php");
    exit;
} else {
    // Não logado → vai para login
    header("Location: login.php");
    exit;
}
?>
