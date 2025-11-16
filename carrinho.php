<?php
session_start();
include("conexao.php");

$carrinhoID = $_SESSION['carrinho_id'] ?? null;
$pedidoID   = $_SESSION['pedido_id'] ?? null;

$itens = [];
$total = 0;

if ($carrinhoID) {
    $sql = "SELECT cp.ProdutoID, cp.Quantidade, p.Nome, p.Valor
            FROM Carrinho_Produtos cp
            JOIN Produtos p ON cp.ProdutoID = p.ProdutoID
            WHERE cp.CarrinhoID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $carrinhoID);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $itens[] = $row;
        $total += $row['Quantidade'] * $row['Valor'];
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Seu Carrinho</title>
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
        <li><a href="cardapio.php">Cardápio</a></li>
        <li><a href="login.php">Login</a></li>
      </ul>
    </nav>
  </header>

  <!-- Título fora do quadro -->
  <h2 class="titulo-branco">Carrinho</h2>

  <!-- Quadro centralizado -->
  <main class="container quadro-carrinho">
    <?php if (!empty($itens)) { ?>
      <table>
        <tr>
          <th>Produto</th>
          <th>Quantidade</th>
          <th>Valor Unitário</th>
          <th>Subtotal</th>
          <th>Ações</th>
        </tr>
        <?php foreach ($itens as $item) {
          $subtotal = $item['Quantidade'] * $item['Valor'];
          echo "<tr>
                  <td>{$item['Nome']}</td>
                  <td>{$item['Quantidade']}</td>
                  <td>R$ " . number_format($item['Valor'], 2, ',', '.') . "</td>
                  <td>R$ " . number_format($subtotal, 2, ',', '.') . "</td>
                  <td>
                    <form action='excluir_item.php' method='POST' style='display:inline;'>
                      <input type='hidden' name='produto_id' value='{$item['ProdutoID']}'>
                      <input type='hidden' name='carrinho_id' value='{$carrinhoID}'>
                      <button type='submit' class='btn-excluir'>Excluir</button>
                    </form>
                  </td>
                </tr>";
        } ?>
        <tr>
          <td colspan="4"><strong>Total</strong></td>
          <td><strong>R$ <?= number_format($total, 2, ',', '.') ?></strong></td>
        </tr>
      </table>
    <?php } else { ?>
      <p>Seu carrinho está vazio.</p>
    <?php } ?>

    <!-- Botão Finalizar -->
<?php if (isset($_SESSION['usuario_id'])): ?>
    <!-- Se estiver logado, vai para pagamento -->
    <a href="pagamento.php?pedido_id=<?= $pedidoID ?>" class="btn-finalizar">Finalizar Compra</a>
<?php else: ?>
  
    <!-- Se não estiver logado, não faz nada ou mostra aviso -->
    <button type="submit" class="btn-finalizar" onclick="alert('Você precisa estar logado para finalizar a compra.')">
        Finalizar Compra
    </button>
<?php endif; ?>
    </div>
  </main>

   <!-- Rodapé -->
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
      <i class="fas fa-phone-alt"></i>
      <strong>Telefone: +55(11)99999-9999 ou +55(11)3999-9999</strong>
    </p>
    <p class="dev">
      ©2025 Carlos Alberto Alves Queiroz Filho - Todos os direitos reservados.
    </p>

    <!-- Newsletter -->
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
