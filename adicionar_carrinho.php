<?php
session_start();
include("conexao.php");

if (!empty($_POST['quantidade'])) {
    // Se já existe carrinho na sessão, usa ele
    if (isset($_SESSION['carrinho_id'])) {
        $carrinhoID = $_SESSION['carrinho_id'];
    } else {
        // Cria novo carrinho
        $sql = "INSERT INTO Carrinho (DataCriacao) VALUES (NOW())";
        $con->query($sql);
        $carrinhoID = $con->insert_id;
        $_SESSION['carrinho_id'] = $carrinhoID;
    }

    // Percorre todos os produtos enviados
    foreach ($_POST['quantidade'] as $produtoID => $quantidade) {
        $produtoID = (int)$produtoID;
        $quantidade = (int)$quantidade;

        if ($quantidade > 0) {
            $sql = "INSERT INTO Carrinho_Produtos (CarrinhoID, ProdutoID, Quantidade)
                    VALUES (?, ?, ?)
                    ON DUPLICATE KEY UPDATE Quantidade = Quantidade + VALUES(Quantidade)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("iii", $carrinhoID, $produtoID, $quantidade);
            $stmt->execute();
        }
    }
}

header("Location: carrinho.php");
exit;


// cria carrinho
$con->query("INSERT INTO Carrinho (ValorTotal) VALUES (0)");
$carrinhoID = $con->insert_id;

// percorre todos os produtos enviados
foreach ($_POST['quantidade'] as $produtoID => $qtd) {
    if ($qtd > 0) {
        $stmt = $con->prepare("INSERT INTO Carrinho_Produtos (CarrinhoID, ProdutoID, Quantidade) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $carrinhoID, $produtoID, $qtd);
        $stmt->execute();
    }
}

// recalcula o total
$result = $con->query("SELECT SUM(p.Valor * cp.Quantidade) AS Total
  FROM Carrinho_Produtos cp
  JOIN Produtos p ON cp.ProdutoID = p.ProdutoID
  WHERE cp.CarrinhoID = $carrinhoID");

$total = $result->fetch_assoc()['Total'];
$con->query("UPDATE Carrinho SET ValorTotal = $total WHERE CarrinhoID = $carrinhoID");

$con->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Adicionar ao Carrinho</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="conteudo">
      <h2>Itens adicionados ao carrinho!</h2>
      <p>Agora você pode continuar comprando ou ir para o pagamento.</p>
      <a href="cardapio.php" class="btn-index">Voltar ao Cardápio</a>
      <a href="carrinho.php?carrinho_id=<?php echo $carrinhoID; ?>" class="btn-index">Ver Carrinho</a>
    </main>
</body>
</html>

