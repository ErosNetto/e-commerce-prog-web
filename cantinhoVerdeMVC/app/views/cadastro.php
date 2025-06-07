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
          <li><a href="<?= BASE_URL ?>/categorias">Categorias</a></li>
          <li><a href="<?= BASE_URL ?>/sobre">Sobre</a></li>
          <li><a href="<?= BASE_URL ?>/contato">Contato</a></li>
        </ul>
      </nav>
      <div class="icons">
        <a href="<?= BASE_URL ?>/carrinho"><i class="fas fa-shopping-cart"></i></a>
        <a href="<?= BASE_URL ?>/conta" class="active"><i class="fas fa-user"></i></a>
        <!-- <a href="<?= BASE_URL ?>/pesquisa"><i class="fas fa-search"></i></a> -->
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="main-content">
    <div class="container">
      <div class="auth-container">
        <div class="auth-card">
          <div class="auth-header">
            <h1>Criar sua conta</h1>
            <p>Junte-se à nossa comunidade de amantes de plantas!</p>
          </div>

          <form class="auth-form" id="registerForm">
            <div class="form-row">
              <div class="form-group">
                <label for="firstName">Nome</label>
                <div class="input-wrapper">
                  <i class="fas fa-user"></i>
                  <input type="text" id="firstName" name="firstName" placeholder="Seu nome" required>
                </div>
              </div>

              <div class="form-group">
                <label for="lastName">Sobrenome</label>
                <div class="input-wrapper">
                  <i class="fas fa-user"></i>
                  <input type="text" id="lastName" name="lastName" placeholder="Seu sobrenome" required>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <div class="input-wrapper">
                <i class="fas fa-envelope"></i>
                <input type="email" id="email" name="email" placeholder="seu@email.com" required>
              </div>
            </div>

            <div class="form-group">
              <label for="phone">Telefone</label>
              <div class="input-wrapper">
                <i class="fas fa-phone"></i>
                <input type="tel" id="phone" name="phone" placeholder="(11) 99999-9999" required>
              </div>
            </div>

            <div class="form-group">
              <label for="birthDate">Data de Nascimento</label>
              <div class="input-wrapper">
                <i class="fas fa-calendar"></i>
                <input type="date" id="birthDate" name="birthDate" required>
              </div>
            </div>

            <div class="form-group">
              <label for="password">Senha</label>
              <div class="input-wrapper">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Mínimo 8 caracteres" required>
                <button type="button" class="toggle-password" id="togglePassword">
                  <i class="far fa-eye"></i>
                </button>
              </div>
            </div>

            <div class="form-group">
              <label for="confirmPassword">Confirmar Senha</label>
              <div class="input-wrapper">
                <i class="fas fa-lock"></i>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Digite a senha novamente" required>
                <button type="button" class="toggle-password" id="toggleConfirmPassword">
                  <i class="far fa-eye"></i>
                </button>
              </div>
            </div>

            <button type="submit" class="btn btn-primary btn-full">
              <i class="fas fa-user-plus"></i>
              Criar Conta
            </button>
          </form>

          <div class="auth-footer">
            <p>Já tem uma conta? <a href="<?= BASE_URL ?>/login">Entre aqui</a></p>
          </div>
        </div>

        <div class="auth-benefits">
          <h3>Por que se cadastrar?</h3>
          <ul>
            <li>
              <i class="fas fa-heart"></i>
              <div>
                <strong>Lista de Desejos</strong>
                <p>Salve seus produtos favoritos para comprar depois</p>
              </div>
            </li>
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
            <li>
              <i class="fas fa-star"></i>
              <div>
                <strong>Avaliações</strong>
                <p>Avalie produtos e ajude outros clientes</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <?php require_once 'partials/footer.php'; ?>

  <script src="js/main.js"></script>
  <script src="js/auth.js"></script>
</body>

</html>