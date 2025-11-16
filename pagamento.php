<?php
session_start();
include("conexao.php");
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$carrinhoID = $_SESSION['carrinho_id'] ?? null;
$valorTotal = 0;

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Pagamento</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Amatic+SC&family=Quicksand&family=Montserrat&display=swap" rel="stylesheet">
</head>
<body>
  <header class="topo">
    <img src="imagens/logo.jpg" alt="Logo Black Coffe" class="logo-header">
    <nav class="menu">
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="cardapio.php">Cardápio</a></li>
        <li><a href="carrinho.php">Carrinho</a></li>
        <li><a href="login.php">Login</a></li>
      </ul>
    </nav>
  </header>

  <main class="container">
    <h1 class="titulo-branco">Pagamento</h1>
    <h2>Finalizar Pagamento</h2>

    <!-- Botões estilizados -->
    <button class="btn-index" onclick="pagamentoDinheiro()">Dinheiro</button>
    <button class="btn-index" onclick="pagamentoPix()">Pix</button>

    <div id="resultado" class="mensagem"></div>
  </main>

  <script>
  // Função para enviar atualização ao backend
  function atualizarStatus(metodo) {
  fetch("processar_pagamento.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "forma=" + encodeURIComponent(metodo)
  })
  .then(response => response.json())
  .then(data => {
    document.getElementById('resultado').innerHTML = data.mensagem;
    
  })
  .catch(error => console.error("Erro:", error));
}

  function pagamentoDinheiro() {
    document.getElementById('resultado').innerHTML =
      "<span>Pagamento aceito em Dinheiro, agora é só aguardar seu pedido.</span>";
    atualizarStatus("Dinheiro");
  }

 function pagamentoPix() {
  // caracteres permitidos
  const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

  // palavra obrigatória no meio
  const palavra = "blackcoffe";

  // calcular prefixo e sufixo para totalizar 30 caracteres
  const totalLength = 30;
  const prefixLength = Math.floor((totalLength - palavra.length) / 2);
  const suffixLength = totalLength - palavra.length - prefixLength;

  let prefix = "";
  let suffix = "";

  for (let i = 0; i < prefixLength; i++) {
    prefix += chars.charAt(Math.floor(Math.random() * chars.length));
  }
  for (let i = 0; i < suffixLength; i++) {
    suffix += chars.charAt(Math.floor(Math.random() * chars.length));
  }

  const chave = prefix + palavra + suffix;

  // exibir chave Pix na tela
  document.getElementById('resultado').innerHTML =
    "Use esta chave Pix para pagamento:<br><span class='pix-chave'>" + chave + "</span>" +
    "<button class='btn-preto' onclick='copiarPix(\"" + chave + "\")'>Copiar Chave Pix</button>";

  // enviar para o backend
  atualizarStatus("PIX");
}

  function copiarPix(chave) {
    navigator.clipboard.writeText(chave).then(() => {
      alert("Chave Pix copiada para a área de transferência!");
    });
  }
  </script>

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
        <label for="email">Newsletter:</label>
        <input type="email" id="email" name="email" placeholder="Seu e-mail" required>
        <button type="submit">Ok</button>
      </form>
    </div>
  </footer>
</body>
</html>
