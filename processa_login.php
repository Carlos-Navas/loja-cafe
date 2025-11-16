<?php
session_start();
include("conexao.php");

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if ($email && $senha) {
    $stmt = $con->prepare("SELECT UsuarioID, Senha FROM Usuarios WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();
    $stmt->close();

    if ($usuario && $senha === $usuario['Senha']) {
    $_SESSION['usuario_id'] = $usuario['UsuarioID'];
    header("Location: pagamento.php");
    exit;
} else {
        // Login inválido → volta para login
        header("Location: login.php?erro=1");
        exit;
    }
} else {
    header("Location: login.php?erro=2");
    exit;
}
?>
