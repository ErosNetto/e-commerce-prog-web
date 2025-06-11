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
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/carrinho.css" />
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

  <!-- Page Header -->
  <section class="page-header">
    <div class="container">
      <h1>Carrinho de Compras</h1>
      <div class="breadcrumb">
        <a href="<?= BASE_URL ?>/home">Início</a> / <span>Carrinho</span>
      </div>
    </div>
  </section>

  <?php if (isset($_SESSION['mensagem_sucesso'])): ?>
    <div class="alert alert-success">
      <?= $_SESSION['mensagem_sucesso'] ?>
      <?php unset($_SESSION['mensagem_sucesso']); ?>
    </div>
  <?php endif; ?>

  <?php if (isset($_SESSION['mensagem_erro'])): ?>
    <div class="alert alert-error">
      <?= $_SESSION['mensagem_erro'] ?>
      <?php unset($_SESSION['mensagem_erro']); ?>
    </div>
  <?php endif; ?>

  <section class="cart-section">
    <div class="container">
      <div class="cart-steps">
        <div class="step active">
          <div class="step-number">1</div>
          <div class="step-label">Carrinho</div>
        </div>
        <div class="step-line"></div>
        <div class="step">
          <div class="step-number">2</div>
          <div class="step-label">Finalizar</div>
        </div>
      </div>

      <?php if (empty($itens)): ?>
        <div class="empty-cart">
          <i class="fas fa-shopping-cart"></i>
          <h3>Seu carrinho está vazio</h3>
          <p>Adicione produtos ao seu carrinho para continuar comprando.</p>
          <a href="<?= BASE_URL ?>/produtos" class="btn">Explorar Produtos</a>
        </div>
      <?php else: ?>
        <div class="cart-container">
          <div class="cart-items">
            <div class="cart-header">
              <div class="cart-header-item product-col">Produto</div>
              <div class="cart-header-item price-col">Preço</div>
              <div class="cart-header-item quantity-col">Quantidade</div>
              <div class="cart-header-item subtotal-col">Subtotal</div>
              <div class="cart-header-item action-col"></div>
            </div>

            <?php foreach ($itens as $item): ?>
              <div class="cart-item">
                <div class="product-col">
                  <div class="product-info">
                    <img src="<?= $item['imagem_principal'] ?>" alt="<?= htmlspecialchars($item['produto_nome']) ?>" />
                    <div>
                      <h3><?= htmlspecialchars($item['produto_nome']) ?></h3>
                    </div>
                  </div>
                </div>
                <div class="price-col">
                  <span class="price">R$ <?= number_format($item['preco_unitario'], 2, ',', '.') ?></span>
                </div>
                <div class="quantity-col">
                  <form method="POST" action="<?= BASE_URL ?>/carrinho/atualizar" class="quantity-form">
                    <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                    <div class="quantity-selector">
                      <button type="button" class="quantity-btn decrease-btn" data-item-id="<?= $item['id'] ?>">-</button>
                      <input type="number" name="quantidade" value="<?= $item['quantidade'] ?>" min="1" max="10" class="quantity-input" data-item-id="<?= $item['id'] ?>">
                      <button type="button" class="quantity-btn increase-btn" data-item-id="<?= $item['id'] ?>">+</button>
                    </div>
                  </form>
                </div>
                <div class="subtotal-col">
                  <span class="subtotal">R$ <?= number_format($item['quantidade'] * $item['preco_unitario'], 2, ',', '.') ?></span>
                </div>
                <div class="action-col">
                  <form method="POST" action="<?= BASE_URL ?>/carrinho/remover" style="display: inline;">
                    <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                    <button type="submit" class="remove-btn" onclick="return confirm('Tem certeza que deseja remover este item?')">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>
                </div>
              </div>
            <?php endforeach; ?>

            <div class="cart-actions">
              <form method="POST" action="<?= BASE_URL ?>/carrinho/limpar" style="display: inline;">
                <button type="submit" class="btn btn-outline" onclick="return confirm('Tem certeza que deseja limpar todo o carrinho?')">
                  Limpar Carrinho
                </button>
              </form>
              <a href="<?= BASE_URL ?>/produtos" class="btn-outline">
                Continuar Comprando
              </a>
            </div>
          </div>

          <div class="cart-summary">
            <h2>Resumo do Pedido</h2>

            <div class="summary-item total">
              <span>Total</span>
              <span>R$ <?= number_format($total, 2, ',', '.') ?></span>
            </div>

            <div class="summary-installment">
              <span>ou em até 10x de R$ <?= number_format($total / 10, 2, ',', '.') ?> sem juros</span>
            </div>

            <?php if (Auth::isLoggedIn()): ?>
              <button class="btn checkout-btn" onclick="window.location.href='<?= BASE_URL ?>/pedido/finalizar'">
                Finalizar Pedido
              </button>
            <?php else: ?>
              <button class="btn checkout-btn" onclick="window.location.href='<?= BASE_URL ?>/usuario/login'">
                Fazer Login para Finalizar
              </button>
            <?php endif; ?>

            <div class="secure-checkout">
              <i class="fas fa-lock"></i> Compra 100% Segura
            </div>

            <div class="payment-methods">
              <p>Formas de pagamento aceitas:</p>
              <div class="payment-icons">
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-mastercard"></i>
                <i class="fab fa-cc-amex"></i>
                <i class="fab fa-pix"></i>
                <i class="fas fa-barcode"></i>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <?php require_once 'partials/footer.php'; ?>

  <script>
    // Atualização automática de quantidade
    document.querySelectorAll('.quantity-input').forEach(input => {
      input.addEventListener('change', function() {
        const form = this.closest('.quantity-form');
        form.submit();
      });
    });

    // Botões de aumentar/diminuir quantidade
    document.querySelectorAll('.increase-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const itemId = this.dataset.itemId;
        const input = document.querySelector(`input[data-item-id="${itemId}"]`);
        const currentValue = parseInt(input.value);
        if (currentValue < 10) {
          input.value = currentValue + 1;
          input.dispatchEvent(new Event('change'));
        }
      });
    });

    document.querySelectorAll('.decrease-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const itemId = this.dataset.itemId;
        const input = document.querySelector(`input[data-item-id="${itemId}"]`);
        const currentValue = parseInt(input.value);
        if (currentValue > 1) {
          input.value = currentValue - 1;
          input.dispatchEvent(new Event('change'));
        }
      });
    });

    // Auto-hide alerts
    setTimeout(function() {
      const alerts = document.querySelectorAll('.alert');
      alerts.forEach(alert => {
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 300);
      });
    }, 5000);
  </script>
</body>

</html>