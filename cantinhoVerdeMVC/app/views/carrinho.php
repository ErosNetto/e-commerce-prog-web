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
            <a href="<?= BASE_URL ?>/adminDashboard" title="Painel Administrativo">
              <i class="fas fa-tachometer-alt"></i>
            </a>
          <?php endif; ?>

          <a href="<?= BASE_URL ?>/carrinho" title="Carrinho" class="active">
            <i class="fas fa-shopping-cart"></i>
          </a>

          <a href="<?= BASE_URL ?>/usuario/perfil" title="Meu Perfil">
            <i class="fas fa-user"></i>
            <!-- <span><?= htmlspecialchars(Auth::getUser()['name']) ?></span> -->
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
      <h1>Categorias de Plantas</h1>
      <div class="breadcrumb">
        <a href="<?= BASE_URL ?>/home">Início</a> / <span>Carrinho</span>
      </div>
    </div>
  </section>

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
          <div class="step-label">Entrega</div>
        </div>
        <div class="step-line"></div>
        <div class="step">
          <div class="step-number">3</div>
          <div class="step-label">Pagamento</div>
        </div>
        <div class="step-line"></div>
        <div class="step">
          <div class="step-number">4</div>
          <div class="step-label">Confirmação</div>
        </div>
      </div>

      <div class="cart-container">
        <div class="cart-items">
          <div class="cart-header">
            <div class="cart-header-item product-col">Produto</div>
            <div class="cart-header-item price-col">Preço</div>
            <div class="cart-header-item quantity-col">Quantidade</div>
            <div class="cart-header-item subtotal-col">Subtotal</div>
            <div class="cart-header-item action-col"></div>
          </div>

          <div class="cart-item">
            <div class="product-col">
              <div class="product-info">
                <img src="img/produto1.jpg" alt="Zamioculca" />
                <div>
                  <h3>Zamioculca</h3>
                  <p>Tamanho: Médio | Vaso: Cerâmica</p>
                </div>
              </div>
            </div>
            <div class="price-col">
              <span class="price">R$ 89,90</span>
            </div>
            <div class="quantity-col">
              <div class="quantity-selector">
                <button
                  class="quantity-btn"
                  onclick="updateQuantity(1, 'decrease')">
                  -
                </button>
                <input
                  type="number"
                  id="quantity-1"
                  value="1"
                  min="1"
                  max="10"
                  onchange="updateSubtotal(1)" />
                <button
                  class="quantity-btn"
                  onclick="updateQuantity(1, 'increase')">
                  +
                </button>
              </div>
            </div>
            <div class="subtotal-col">
              <span class="subtotal" id="subtotal-1">R$ 89,90</span>
            </div>
            <div class="action-col">
              <button class="remove-btn" onclick="removeItem(1)">
                <i class="fas fa-trash-alt"></i>
              </button>
            </div>
          </div>

          <div class="cart-item">
            <div class="product-col">
              <div class="product-info">
                <img src="img/produto4.jpg" alt="Costela de Adão" />
                <div>
                  <h3>Costela de Adão</h3>
                  <p>Tamanho: Grande | Vaso: Cerâmica</p>
                </div>
              </div>
            </div>
            <div class="price-col">
              <span class="price">R$ 119,90</span>
            </div>
            <div class="quantity-col">
              <div class="quantity-selector">
                <button
                  class="quantity-btn"
                  onclick="updateQuantity(2, 'decrease')">
                  -
                </button>
                <input
                  type="number"
                  id="quantity-2"
                  value="2"
                  min="1"
                  max="10"
                  onchange="updateSubtotal(2)" />
                <button
                  class="quantity-btn"
                  onclick="updateQuantity(2, 'increase')">
                  +
                </button>
              </div>
            </div>
            <div class="subtotal-col">
              <span class="subtotal" id="subtotal-2">R$ 239,80</span>
            </div>
            <div class="action-col">
              <button class="remove-btn" onclick="removeItem(2)">
                <i class="fas fa-trash-alt"></i>
              </button>
            </div>
          </div>

          <div class="cart-actions">
            <div class="coupon">
              <input type="text" placeholder="Código do cupom" />
              <button class="btn">Aplicar Cupom</button>
            </div>
            <button
              class="btn-outline"
              onclick="window.location.href='produtos.html'">
              Continuar Comprando
            </button>
          </div>
        </div>

        <div class="cart-summary">
          <h2>Resumo do Pedido</h2>

          <div class="summary-item">
            <span>Subtotal</span>
            <span id="cart-subtotal">R$ 329,70</span>
          </div>

          <div class="summary-item">
            <span>Desconto</span>
            <span id="cart-discount">R$ 0,00</span>
          </div>

          <div class="summary-item">
            <span>Frete</span>
            <span id="cart-shipping">Calculado na próxima etapa</span>
          </div>

          <div class="summary-divider"></div>

          <div class="summary-item total">
            <span>Total</span>
            <span id="cart-total">R$ 329,70</span>
          </div>

          <div class="summary-installment">
            <span>ou em até 10x de R$ 32,97 sem juros</span>
          </div>

          <button
            class="btn checkout-btn"
            onclick="window.location.href='checkout-entrega.html'">
            Prosseguir para Entrega
          </button>

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
    </div>
  </section>

  <?php require_once 'partials/footer.php'; ?>

  <script>
    // Funções para o carrinho de compras
    function updateQuantity(itemId, action) {
      const quantityInput = document.getElementById(`quantity-${itemId}`);
      let currentValue = parseInt(quantityInput.value);

      if (action === 'increase' && currentValue < 10) {
        quantityInput.value = currentValue + 1;
      } else if (action === 'decrease' && currentValue > 1) {
        quantityInput.value = currentValue - 1;
      }

      updateSubtotal(itemId);
      updateCartTotal();
    }

    function updateSubtotal(itemId) {
      const quantityInput = document.getElementById(`quantity-${itemId}`);
      const quantity = parseInt(quantityInput.value);

      let price = 0;
      if (itemId === 1) {
        price = 89.9;
      } else if (itemId === 2) {
        price = 119.9;
      }

      const subtotal = price * quantity;
      document.getElementById(
        `subtotal-${itemId}`
      ).textContent = `R$ ${subtotal.toFixed(2)}`;

      updateCartTotal();
    }

    function updateCartTotal() {
      const subtotal1 = parseFloat(
        document.getElementById('subtotal-1').textContent.replace('R$ ', '')
      );
      const subtotal2 = parseFloat(
        document.getElementById('subtotal-2').textContent.replace('R$ ', '')
      );

      const cartSubtotal = subtotal1 + subtotal2;
      const discount = 0; // Pode ser calculado com base em cupons
      const total = cartSubtotal - discount;

      document.getElementById(
        'cart-subtotal'
      ).textContent = `R$ ${cartSubtotal.toFixed(2)}`;
      document.getElementById(
        'cart-discount'
      ).textContent = `R$ ${discount.toFixed(2)}`;
      document.getElementById('cart-total').textContent = `R$ ${total.toFixed(
          2
        )}`;

      // Atualiza o valor das parcelas
      const installment = total / 10;
      document.querySelector(
        '.summary-installment span'
      ).textContent = `ou em até 10x de R$ ${installment.toFixed(
          2
        )} sem juros`;
    }

    function removeItem(itemId) {
      const cartItem = document
        .getElementById(`quantity-${itemId}`)
        .closest('.cart-item');
      cartItem.style.opacity = '0';
      setTimeout(() => {
        cartItem.remove();
        updateCartTotal();

        // Verifica se o carrinho está vazio
        const cartItems = document.querySelectorAll('.cart-item');
        if (cartItems.length === 0) {
          showEmptyCart();
        }
      }, 300);
    }

    function showEmptyCart() {
      const cartItems = document.querySelector('.cart-items');
      cartItems.innerHTML = `
                <div class="empty-cart">
                    <i class="fas fa-shopping-cart"></i>
                    <h3>Seu carrinho está vazio</h3>
                    <p>Adicione produtos ao seu carrinho para continuar comprando.</p>
                    <a href="produtos.html" class="btn">Explorar Produtos</a>
                </div>
            `;

      // Atualiza o resumo do pedido
      document.getElementById('cart-subtotal').textContent = 'R$ 0,00';
      document.getElementById('cart-discount').textContent = 'R$ 0,00';
      document.getElementById('cart-total').textContent = 'R$ 0,00';
      document.querySelector('.summary-installment span').textContent =
        'ou em até 10x de R$ 0,00 sem juros';

      // Desabilita o botão de checkout
      const checkoutBtn = document.querySelector('.checkout-btn');
      checkoutBtn.disabled = true;
      checkoutBtn.classList.add('disabled');
    }
  </script>
</body>

</html>