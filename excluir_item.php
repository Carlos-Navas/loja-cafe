<?php
session_start();
include("conexao.php");

$produtoID  = (int)($_POST['produto_id'] ?? 0);
$carrinhoID = (int)($_POST['carrinho_id'] ?? 0);

if ($produtoID && $carrinhoID) {
    // Verifica a quantidade atual
    $stmt = $con->prepare("SELECT Quantidade FROM Carrinho_Produtos WHERE CarrinhoID = ? AND ProdutoID = ?");
    $stmt->bind_param("ii", $carrinhoID, $produtoID);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();
    $stmt->close();

    if ($item) {
        $quantidadeAtual = (int)$item['Quantidade'];

        if ($quantidadeAtual > 1) {
            // Se tiver mais de 1, apenas decrementa
            $stmt = $con->prepare("UPDATE Carrinho_Produtos SET Quantidade = Quantidade - 1 WHERE CarrinhoID = ? AND ProdutoID = ?");
            $stmt->bind_param("ii", $carrinhoID, $produtoID);
            $stmt->execute();
            $stmt->close();
        } else {
            // Se tiver só 1, remove a linha
            $stmt = $con->prepare("DELETE FROM Carrinho_Produtos WHERE CarrinhoID = ? AND ProdutoID = ?");
            $stmt->bind_param("ii", $carrinhoID, $produtoID);
            $stmt->execute();
            $stmt->close();
        }
    }
}

// Redireciona de volta para o carrinho
header("Location: carrinho.php");
exit;
?>
