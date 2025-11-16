<?php
session_start();
include("conexao.php");

// Verifica se há carrinho ativo e usuário logado
$carrinhoID = $_SESSION['carrinho_id'] ?? null;
$usuarioID  = $_SESSION['usuario_id'] ?? null; // precisa ser setado no login.php

if ($carrinhoID && $usuarioID) {
    // Busca itens do carrinho
    $sql = "SELECT cp.ProdutoID, cp.Quantidade, p.Valor
            FROM Carrinho_Produtos cp
            JOIN Produtos p ON cp.ProdutoID = p.ProdutoID
            WHERE cp.CarrinhoID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $carrinhoID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $total = 0;
        $itens = [];

        while ($row = $result->fetch_assoc()) {
            $produtoID   = (int)$row['ProdutoID'];
            $quantidade  = (int)$row['Quantidade'];
            $valorUnit   = (float)$row['Valor'];
            $subtotal    = $valorUnit * $quantidade;
            $total      += $subtotal;

            $itens[] = [
                'ProdutoID' => $produtoID,
                'Quantidade' => $quantidade,
                'ValorUnitario' => $valorUnit
            ];
        }

// Grava pedido
$sqlPedido = "INSERT INTO Pedidos (UsuarioID, DataPedido, Status, Total)
              VALUES (?, NOW(), 'Pendente', ?)";
$stmtPedido = $con->prepare($sqlPedido);
$stmtPedido->bind_param("id", $usuarioID, $total);
$stmtPedido->execute();
$pedidoID = $stmtPedido->insert_id; // pegar antes de fechar
$stmtPedido->close();

// Grava itens do pedido
$sqlItem = "INSERT INTO Pedido_Itens (PedidoID, ProdutoID, Quantidade, ValorUnitario)
            VALUES (?, ?, ?, ?)";
$stmtItem = $con->prepare($sqlItem);

foreach ($itens as $item) {
    $stmtItem->bind_param(
        "iiid",
        $pedidoID,
        $item['ProdutoID'],
        $item['Quantidade'],
        $item['ValorUnitario']
    );
    $stmtItem->execute();
}
$stmtItem->close();

        // Limpa carrinho (corrigido para prepared statement)
        $stmtDel = $con->prepare("DELETE FROM Carrinho_Produtos WHERE CarrinhoID = ?");
        $stmtDel->bind_param("i", $carrinhoID);
        $stmtDel->execute();
        $stmtDel->close();

        unset($_SESSION['carrinho_id']);

        // Redireciona para página de pagamento
        header("Location: pagamento.php?pedido_id=" . $pedidoID);
        exit;
    } else {
        echo "<p>Seu carrinho está vazio.</p>";
    }
} else {
    echo "<p>É necessário estar logado e ter itens no carrinho para finalizar a compra.</p>";
}
$stmt->close();
$con->close();
?>
