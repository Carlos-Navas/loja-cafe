<?php
session_start();
include("conexao.php");

header('Content-Type: application/json');

$usuarioID  = $_SESSION['usuario_id'] ?? null;
$carrinhoID = $_SESSION['carrinho_id'] ?? null;
$forma      = $_POST['forma'] ?? null;

if (!$usuarioID || !$carrinhoID || !$forma) {
    echo json_encode(["mensagem" => "Dados inválidos."]);
    exit;
}

// 1. Calcula o total do carrinho
$total = 0;
$sqlTotal = "SELECT cp.Quantidade, p.Valor
             FROM Carrinho_Produtos cp
             JOIN Produtos p ON cp.ProdutoID = p.ProdutoID
             WHERE cp.CarrinhoID = ?";
$stmtTotal = $con->prepare($sqlTotal);
if (!$stmtTotal) {
    echo json_encode(["mensagem" => "Erro ao preparar cálculo de total: " . $con->error]);
    exit;
}
$stmtTotal->bind_param("i", $carrinhoID);
$stmtTotal->execute();
$resultTotal = $stmtTotal->get_result();

while ($row = $resultTotal->fetch_assoc()) {
    $total += $row['Valor'] * $row['Quantidade'];
}
$stmtTotal->close();

// 2. Grava o pedido com total
$sqlPedido = "INSERT INTO pedidos (UsuarioID, DataPedido, Status, ValorTotal) 
              VALUES (?, NOW(), 'Pago', ?)";
$stmtPedido = $con->prepare($sqlPedido);
if (!$stmtPedido) {
    echo json_encode(["mensagem" => "Erro ao preparar gravação do pedido: " . $con->error]);
    exit;
}
$stmtPedido->bind_param("id", $usuarioID, $total);

if ($stmtPedido->execute()) {
    // 3. Zera o carrinho (remove os itens)
    $sqlLimpar = "DELETE FROM Carrinho_Produtos WHERE CarrinhoID = ?";
    $stmtLimpar = $con->prepare($sqlLimpar);
    if ($stmtLimpar) {
        $stmtLimpar->bind_param("i", $carrinhoID);
        $stmtLimpar->execute();
        $stmtLimpar->close();
    }

    // 4. Remove carrinho da sessão
    unset($_SESSION['carrinho_id']);

    echo json_encode([
        "mensagem" => "Pagamento registrado com sucesso. Total: R$ " . number_format($total, 2, ',', '.') . 
                      " | Carrinho zerado."
    ]);
} else {
    echo json_encode(["mensagem" => "Erro ao registrar pedido: " . $stmtPedido->error]);
}
 if ($stmtPedido->execute()) {
    // Gerar chave Pix de 30 caracteres com "blackcoffe" no meio
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    $palavra = "blackcoffe";
    $totalLength = 30;
    $prefixLength = floor(($totalLength - strlen($palavra)) / 2);
    $suffixLength = $totalLength - strlen($palavra) - $prefixLength;

    $prefix = "";
    $suffix = "";
    for ($i = 0; $i < $prefixLength; $i++) {
        $prefix .= $chars[random_int(0, strlen($chars) - 1)];
    }
    for ($i = 0; $i < $suffixLength; $i++) {
        $suffix .= $chars[random_int(0, strlen($chars) - 1)];
    }
    $chavePix = $prefix . $palavra . $suffix;

    // Zera o carrinho
    $sqlLimpar = "DELETE FROM Carrinho_Produtos WHERE CarrinhoID = ?";
    $stmtLimpar = $con->prepare($sqlLimpar);
    if ($stmtLimpar) {
        $stmtLimpar->bind_param("i", $carrinhoID);
        $stmtLimpar->execute();
        $stmtLimpar->close();
    }
    unset($_SESSION['carrinho_id']);

    // Retorna a chave Pix no JSON
    echo json_encode([
        "mensagem" => "Use esta chave Pix para pagamento:<br><span class='pix-chave'>" . $chavePix . "</span>"
    ]);
} else {
    echo json_encode(["mensagem" => "Erro ao registrar pedido: " . $stmtPedido->error]);
}

$stmtPedido->close();

$con->close();
?>
