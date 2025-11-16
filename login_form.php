

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
        <li><a href="sobre_nos.html">Sobre Nós</a></li>
        <li><a href="cardapio.php">Cardápio</a></li>
        <li><a href="carrinho.php">Carrinho</a></li>
        <li><a href="login.php">Login</a></li>
      </ul>
    </nav>
  </header>

<main class="conteudo">
  <div class="form-box">
    <form method="POST" action="login.php">
  <input type="hidden" name="acao" value="login">
  <label>E-mail:</label>
  <input type="email" name="email" class="campo-form" required>
  <label>Senha:</label>
  <input type="password" name="senha" class="campo-form" required>
  <button type="submit" class="btn-index">Entrar</button>
</form>
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
