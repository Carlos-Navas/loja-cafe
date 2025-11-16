<?php
session_start();
include("conexao.php");

$carrinhoID = $_SESSION['carrinho_id'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Finalizar Compra - Black Coffe</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
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

<main class="conteudo">
  <h2>Finalizar Compra</h2>

  <?php
  if ($carrinhoID) {
      $sql = "SELECT cp.ProdutoID, cp.Quantidade, p.Nome, p.Valor
              FROM Carrinho_Produtos cp
              JOIN Produtos p ON cp.ProdutoID = p.ProdutoID
              WHERE cp.CarrinhoID = ?";
      $stmt = $con->prepare($sql);
      if ($stmt) {
          $stmt->bind_param("i", $carrinhoID);
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result && $result->num_rows > 0) {
              $total = 0;
              echo "<table class='tabela-carrinho'>";
              echo "<tr><th>Produto</th><th>Quantidade</th><th>Subtotal</th></tr>";

              while ($row = $result->fetch_assoc()) {
                  $nome       = htmlspecialchars($row['Nome']);
                  $quantidade = (int)$row['Quantidade'];
                  $valor      = (float)$row['Valor'];
                  $subtotal   = $valor * $quantidade;
                  $total     += $subtotal;

                  echo "<tr>";
                  echo "<td>{$nome}</td>";
                  echo "<td>{$quantidade}</td>";
                  echo "<td>R$ " . number_format($subtotal, 2, ',', '.') . "</td>";
                  echo "</tr>";
              }

              echo "<tr><td colspan='2'><strong>Total</strong></td>
                        <td><strong>R$ " . number_format($total, 2, ',', '.') . "</strong></td></tr>";
              echo "</table>";

              echo "<div class='btn-area'>
                      <form method='POST' action='processa_checkout.php'>
                        <input type='hidden' name='carrinho_id' value='{$carrinhoID}'>
                        <button type='submit' class='btn-index'>Confirmar Pedido</button>
                      </form>
                    </div>";
          } else {
              echo "<p class='msg-vazio'>Seu carrinho está vazio. Adicione itens antes de finalizar a compra.</p>";
              
          }
          $stmt->close();
      } else {
          echo "<p>Erro ao preparar consulta: " . htmlspecialchars($con->error) . "</p>";
      }
  } else {
      echo "<p class='msg-vazio'>Nenhum carrinho ativo. Adicione itens antes de finalizar a compra.</p>";
      
  }


      $con->close();
  
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
</body>
</html>
