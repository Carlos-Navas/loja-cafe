<?php
include("conexao.php");

$email = $_POST['email'];

$stmt = $con->prepare("INSERT INTO Newsletter (Email) VALUES (?)");
$stmt->bind_param("s", $email);

if ($stmt->execute()) {
    echo "<h2>Obrigado por se cadastrar na nossa newsletter!</h2>";
    echo "<a href='index.html'>Voltar</a>";
} else {
    echo "Erro ao cadastrar: " . $con->error;
}

$con->close();
?>
