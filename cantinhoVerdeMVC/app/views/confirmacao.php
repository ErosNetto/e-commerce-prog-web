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
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/confirmacao.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>
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

          <a href="<?= BASE_URL ?>/carrinho" title="Carrinho" class="active">
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

  <!-- Confirmation Section -->
  <section class="confirmation-section">
    <div class="container">
      <div class="confirmation-container">
        <div class="confirmation-header">
          <div class="confirmation-icon">
            <i class="fas fa-check-circle"></i>
          </div>
          <h1 class="confirmation-title">Pedido Confirmado!</h1>
          <p class="confirmation-message">
            Obrigado por sua compra. Seu pedido foi recebido e está sendo
            processado.
          </p>
        </div>

        <div class="order-info">
          <div class="order-info-item">
            <div class="info-label">Número do Pedido</div>
            <div class="info-value">#<?= $pedido['id'] ?></div>
          </div>
          <div class="order-info-item">
            <div class="info-label">Data</div>
            <div class="info-value"><?= date('d/m/Y H:i', strtotime($pedido['data_pedido'])) ?></div>
          </div>
          <div class="order-info-item">
            <div class="info-label">Total</div>
            <div class="info-value">R$<?= number_format($pedido['total'], 2, ',', '.') ?></div>
          </div>
        </div>

        <div class="order-details">
          <h2 class="section-title">Detalhes do Pedido</h2>

          <?php foreach ($itens as $item): ?>
            <div class="order-item">
              <div class="item-image">
                <img src="<?= BASE_URL ?>/images/products/<?= $item['imagem'] ?>" alt="<?= htmlspecialchars($item['nome']) ?>" />
              </div>
              <div class="item-details">
                <h3 class="item-name"><?= htmlspecialchars($item['nome']) ?></h3>
              </div>
              <div class="item-quantity"><?= $item['quantidade'] ?></div>
              <div class="item-price">R$<?= number_format($item['preco_unitario'], 2, ',', '.') ?></div>
            </div>
          <?php endforeach; ?>

          <div class="order-summary">
            <div class="summary-row total">
              <span>Total</span>
              <span>R$<?= number_format($pedido['total'], 2, ',', '.') ?></span>
            </div>
          </div>
        </div>

        <div class="confirmation-actions">
          <a href="<?= BASE_URL ?>/usuario/perfil#orders" class="btn-view-orders">Ver Meus Pedidos</a>
          <a href="<?= BASE_URL ?>/produtos" class="btn-continue-shopping">Continuar Comprando</a>
        </div>
      </div>
    </div>
  </section>

  <?php require_once 'partials/footer.php'; ?>
</body>

</html>