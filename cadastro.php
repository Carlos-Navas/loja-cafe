<?php
session_start();
include("conexao.php");

$erro = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim($_POST['nome'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $endereco = trim($_POST['endereco'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $senha    = $_POST['senha'] ?? '';

    if ($nome === '' || $telefone === '' || $endereco === '' || $email === '' || $senha === '') {
        $erro = "Preencha todos os campos.";
    } else {
        $stmt = $con->prepare("SELECT UsuarioID FROM usuarios WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $erro = "Já existe um usuário com este e-mail.";
        } else {
            $hash = password_hash($senha, PASSWORD_DEFAULT);

            $stmtInsert = $con->prepare("INSERT INTO usuarios (Nome, Telefone, Endereco, Email, Senha) VALUES (?, ?, ?, ?, ?)");
            $stmtInsert->bind_param("sssss", $nome, $telefone, $endereco, $email, $hash);

            if ($stmtInsert->execute()) {
                $sucesso = "Usuário cadastrado com sucesso! Agora você pode fazer login.";
            } else {
                $erro = "Erro ao cadastrar: " . $stmtInsert->error;
            }

            $stmtInsert->close();
        }

        $stmt->close();
    }
}

$con->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro - Black Coffe</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Amatic+SC&family=Quicksand&family=Montserrat&display=swap" rel="stylesheet">
</head>
<body>
  <!-- Header -->
  <header class="topo">
    <img src="imagens/logo.jpg" alt="Logo Black Coffe" class="logo-header">
    <nav class="menu">
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="sobre_nos.html">Sobre Nós</a></li>
        <li><a href="cardapio.php">Cardápio</a></li>
        <li><a href="carrinho.php">Carrinho</a></li>
        <li><a href="login.php">Login</a></li>
      </ul>
    </nav>
  </header>

  <?php if (!empty($erro)): ?>
    <p style="color:red;"><?= htmlspecialchars($erro) ?></p>
  <?php endif; ?>

  <?php if (!empty($sucesso)): ?>
    <p style="color:green;"><?= htmlspecialchars($sucesso) ?></p>
  <?php endif; ?>

  <h2 class="titulo-cadastro">Cadastro de Usuário</h2>
  
 <!-- Container do formulário -->
<div class="quadro-cadastro">
  <form method="POST" action="cadastro.php" class="form-cadastro">
    <label for="nome">Nome</label>
    <input type="text" name="nome" id="nome" required>

    <label for="telefone">Telefone</label>
    <input type="text" name="telefone" id="telefone" required>

    <label for="endereco">Endereço</label>
    <input type="text" name="endereco" id="endereco" required>

    <label for="email">E-mail</label>
    <input type="email" name="email" id="email" required>

    <label for="senha">Senha</label>
    <input type="password" name="senha" id="senha" required>

    <button type="submit">Cadastrar</button>
  </form>
</div>

<footer>
  <p>
    <a href="https://www.instagram.com/seuusuario" target="_blank">
      <i class="fab fa-instagram" style="margin-right:8px;"></i>Black Coffe
    </a>
  </p>
   <p>
    <a href="https://wa.me/5511999999999" target="_blank">
      <i class="fab fa-whatsapp"></i> +55(11)99999-9999
    </a>
  </p>
   <p>
    <i class="fas fa-phone-alt"></i> <strong>Telefone: +55(11)99999-9999 ou +55(11)3999-9999</strong>
  </p>
  <p class="dev">©2025 Carlos Alberto Alves Queiroz Filho - Todos os direitos reservados.</p>
 <div class="newsletter">
    <form action="cadastro-newsletter.php" method="POST">
      <label for="email">newsletter:</label>
      <input type="email" id="email" name="email" placeholder="Seu e-mail" required>
      <button type="submit">Ok</button>
    </form>
  </div>
</footer>
</body>
</html>
