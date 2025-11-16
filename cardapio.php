<?php
session_start();
include("conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Cardápio</title>
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
        <li><a href="sobre_nos.html">Sobre Nós</a></li>
        <li><a href="carrinho.php">Carrinho</a></li>
        <li><a href="login.php">Login</a></li>
      </ul>
    </nav>
  </header>

<!-- Conteúdo principal -->
  <main>
    <h2 class="titulo-branco">Cardápio</h2>
    
 <?php
$result = $con->query("SELECT * FROM Produtos");

  if ($result && $result->num_rows > 0) {
      echo "<form action='adicionar_carrinho.php' method='POST'>";
      while ($p = $result->fetch_assoc()) {
          echo "<div class='produto'>";
          echo "<h3>{$p['Nome']}</h3>";
          echo "<p>{$p['Descricao']}</p>";
          echo "<p><strong>R$ " . number_format($p['Valor'], 2, ',', '.') . "</strong></p>";
          echo "<label>Quantidade:</label>";
          echo "<input type='number' name='quantidade[{$p['ProdutoID']}]' value='0' min='0'>";
          echo "</div>";
      }
      echo "<button type='submit' class='btn-index'>Adicionar ao Carrinho</button>";
      echo "</form>";
  } else {
      echo "<p>Nenhum produto cadastrado.</p>";
  }
  ?>
</main>


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
