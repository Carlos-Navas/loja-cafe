<?php
// Inicie a sessão para controlar login
session_start();


if (isset($_SESSION['usuario_id'])): ?>
<?php endif; 

// Ajuste sua conexão PDO
try {
    $pdo = new PDO('mysql:host=localhost;dbname=lojacafe;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erro de conexão: ' . $e->getMessage());
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $senhaDigitada = isset($_POST['senha']) ? $_POST['senha'] : '';

    if ($email === '' || $senhaDigitada === '') {
        $erro = 'Informe e-mail e senha.';
    } else {
        // Busca o usuário pelo e-mail
        $stmt = $pdo->prepare('SELECT UsuarioID, Nome, Email, Senha FROM usuarios WHERE Email = :email LIMIT 1');
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            // Verifica a senha digitada contra o hash do banco
            if (password_verify($senhaDigitada, $usuario['Senha'])) {
                // Opcional: rehash automático se necessário
                if (password_needs_rehash($usuario['Senha'], PASSWORD_DEFAULT)) {
                    $novoHash = password_hash($senhaDigitada, PASSWORD_DEFAULT);
                    $u = $pdo->prepare('UPDATE usuarios SET Senha = :senha WHERE UsuarioID = :id');
                    $u->execute([':senha' => $novoHash, ':id' => $usuario['UsuarioID']]);
                }

                // Marca sessão como logada
                $_SESSION['usuario_id'] = $usuario['UsuarioID'];
                $_SESSION['usuario_nome'] = $usuario['Nome'];
                $_SESSION['usuario_email'] = $usuario['Email'];

                // Redireciona para a página do carrinho ou dashboard
                header('Location: index.html');
                exit;
            } else {
                $erro = 'Senha inválida.';
            }
        } else {
            $erro = 'Usuário não encontrado.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Black Coffe</title>
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
      </ul>
    </nav>
  </header>
    <div class="container">
        <h2 class="titulo-cadastro">Login</h2>

        <?php if (!empty($erro)): ?>
            <div class="erro"><?php echo htmlspecialchars($erro); ?></div>
            <?php endif; ?>

      <div class="quadro-cadastro">
        <form method="POST" action="login.php"class="form-cadastro">

        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" required autocomplete="username">
        
        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha" required autocomplete="current-password">
        
            <button type="submit" class="btn-login">Entrar</button>

            <div class="links">
    <a href="cadastro.php">Cadastrar Usuário</a>
</div>

        </form>
          </div>
      </div>

      

     <!-- Usuário já está logado -->
    <form method="POST" action="logout.php"class="form-cadastro">
        <button type="submit" class="btn-finalizar">Deslogar</button>
    </form>


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

</body>
</html>