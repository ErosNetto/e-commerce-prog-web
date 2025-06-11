<?php
require_once '../app/helpers/Auth.php';
Auth::iniciarSessao();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= APP_NAME ?></title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css" />
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/auth.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>
  <!-- Header -->
  <header>
    <div class="container">
      <div class="logo">
        <h1>Cantinho<span>Verde</span></h1>
      </div>
      <nav>
        <ul>
          <li><a href="<?= BASE_URL ?>/home">Início</a></li>
          <li><a href="<?= BASE_URL ?>/produtos">Produtos</a></li>
          <li><a href="<?= BASE_URL ?>/sobre">Sobre</a></li>
          <li><a href="<?= BASE_URL ?>/contato">Contato</a></li>
        </ul>
      </nav>
      <div class="icons">
        <?php if (Auth::isLoggedIn()): ?>
          <?php if (Auth::isAdmin()): ?>
            <a href="<?= BASE_URL ?>/adminProdutos" title="Painel Administrativo">
              <i class="fas fa-tachometer-alt"></i>
            </a>
          <?php endif; ?>

          <a href="<?= BASE_URL ?>/carrinho" title="Carrinho">
            <i class="fas fa-shopping-cart"></i>
          </a>

          <a href="<?= BASE_URL ?>/usuario/perfil" title="Meu Perfil">
            <i class="fas fa-user"></i>
          </a>

          <a href="<?= BASE_URL ?>/usuario/logout" title="Sair">
            <i class="fas fa-sign-out-alt"></i>
          </a>
        <?php else: ?>
          <a href="<?= BASE_URL ?>/usuario/login" title="Carrinho">
            <i class="fas fa-shopping-cart"></i>
          </a>
          <a href="<?= BASE_URL ?>/usuario/login" title="Login">
            <i class="fas fa-user"></i>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="main-content">
    <div class="container">
      <div class="auth-container">
        <div class="auth-card">
          <div class="auth-header">
            <h1>Entrar na sua conta</h1>
            <p>Bem-vindo de volta! Entre com seus dados para acessar sua conta.</p>
          </div>

          <?php if (isset($_SESSION['mensagem_sucesso'])): ?>
            <div class="alert alert-success">
              <i class="fas fa-check-circle"></i>
              <?= $_SESSION['mensagem_sucesso'] ?>
            </div>
            <?php unset($_SESSION['mensagem_sucesso']); ?>
          <?php endif; ?>

          <?php if (isset($_SESSION['mensagem_erro'])): ?>
            <div class="alert alert-error">
              <i class="fas fa-exclamation-circle"></i>
              <?= $_SESSION['mensagem_erro'] ?>
            </div>
            <?php unset($_SESSION['mensagem_erro']); ?>
          <?php endif; ?>

          <?php if (isset($erros) && !empty($erros)): ?>
            <div class="alert alert-error">
              <i class="fas fa-exclamation-circle"></i>
              <ul>
                <?php foreach ($erros as $erro): ?>
                  <li><?= htmlspecialchars($erro) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

          <form class="auth-form" method="POST" action="<?= BASE_URL ?>/usuario/login" id="loginForm">
            <div class="form-group">
              <label for="email">Email</label>
              <div class="input-wrapper">
                <i class="fas fa-envelope"></i>
                <input type="email" id="email" name="email" placeholder="Digite seu email"
                  value="<?= isset($dados_antigos['email']) ? htmlspecialchars($dados_antigos['email']) : '' ?>" required>
              </div>
            </div>

            <div class="form-group">
              <label for="senha">Senha</label>
              <div class="input-wrapper">
                <i class="fas fa-lock"></i>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                <button type="button" class="toggle-password" id="togglePassword">
                  <i class="far fa-eye"></i>
                </button>
              </div>
            </div>

            <button type="submit" class="btn btn-primary btn-full">
              <i class="fas fa-sign-in-alt"></i>
              Entrar
            </button>
          </form>

          <div class="auth-footer">
            <p>Não tem uma conta? <a href="<?= BASE_URL ?>/usuario/cadastro">Cadastre-se aqui</a></p>
          </div>
        </div>

        <div class="auth-benefits">
          <h3>Vantagens de ter uma conta</h3>
          <ul>
            <li>
              <i class="fas fa-shipping-fast"></i>
              <div>
                <strong>Checkout Rápido</strong>
                <p>Finalize suas compras mais rapidamente</p>
              </div>
            </li>
            <li>
              <i class="fas fa-history"></i>
              <div>
                <strong>Histórico de Pedidos</strong>
                <p>Acompanhe todos os seus pedidos em um só lugar</p>
              </div>
            </li>
            <li>
              <i class="fas fa-gift"></i>
              <div>
                <strong>Ofertas Exclusivas</strong>
                <p>Receba promoções especiais por email</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <?php require_once 'partials/footer.php'; ?>

  <script src="<?= BASE_URL ?>/js/auth.js"></script>
</body>

</html>