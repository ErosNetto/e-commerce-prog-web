<?php
require_once '../app/helpers/Auth.php';

Auth::iniciarSessao();

$usuario = Auth::getUser();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= APP_NAME ?></title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css" />
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/conta.css" />
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

          <a href="<?= BASE_URL ?>/carrinho" title="Carrinho">
            <i class="fas fa-shopping-cart"></i>
          </a>

          <a href="<?= BASE_URL ?>/usuario/perfil" title="Meu Perfil" class="active">
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
      <h1>Categorias de Plantas</h1>
      <div class="breadcrumb">
        <a href="<?= BASE_URL ?>/home">Início</a> / <span>Minha Conta</span>
      </div>
    </div>
  </section>

  <section class="account-section">
    <div class="container containerTeste">
      <div class="account-container">
        <div class="account-sidebar">
          <div class="user-info">
            <h3><?= htmlspecialchars(Auth::getUser()['name']) ?></h3>
            <p><?= htmlspecialchars(Auth::getUser()['email']) ?></p>
          </div>

          <nav class="account-nav">
            <ul>
              <li class="active"><a href="#orders" data-tab="orders"><i class="fas fa-shopping-bag"></i> Meus Pedidos</a></li>
              <li><a href="<?= BASE_URL ?>/usuario/logout"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
            </ul>
          </nav>
        </div>

        <div class="account-content">
          <!-- Orders Tab -->
          <div class="account-tab active" id="orders">
            <h2>Meus Pedidos</h2>

            <?php if (!empty($pedidos)) : ?>
              <?php foreach ($pedidos as $pedido) : ?>
                <div class="order-card">
                  <div class="order-header">
                    <div class="order-header-left">
                      <div class="order-id">#<?= $pedido['id'] ?></div>
                      <div class="order-date"><?= date('d/m/Y', strtotime($pedido['data_pedido'])) ?></div>
                    </div>
                    <div class="order-header-right">
                      <div class="order-status delivered">Entregue</div>
                      <div class="order-total">R$ <?= number_format($pedido['total'], 2, ',', '.') ?></div>
                    </div>
                  </div>

                  <div class="order-products">
                    <?php foreach ($pedido['itens'] as $item) : ?>
                      <div class="order-product">
                        <img src="<?= BASE_URL ?>/uploads/<?= $item['imagem_principal'] ?>" alt="<?= htmlspecialchars($item['nome']) ?>">
                        <div class="product-details">
                          <h4><?= htmlspecialchars($item['nome']) ?></h4>
                          <div class="product-price">
                            <span class="quantity"><?= $item['quantidade'] ?>x</span>
                            <span class="price">R$ <?= number_format($item['preco_unitario'], 2, ',', '.') ?></span>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>

                  <div class="order-actions">
                    <button class="btn-outline">Ver Detalhes</button>
                    <button class="btn">Comprar Novamente</button>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else : ?>
              <p>Você ainda não fez nenhum pedido.</p>
            <?php endif; ?>


          </div>
        </div>
      </div>
    </div>
  </section>

  <?php require_once 'partials/footer.php'; ?>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const tabLinks = document.querySelectorAll('.account-nav a[data-tab]');
      const tabContents = document.querySelectorAll('.account-tab');

      function activateTab(tabId) {
        tabLinks.forEach(link => link.parentElement.classList.remove('active'));
        tabContents.forEach(tab => tab.classList.remove('active'));

        const selectedLink = document.querySelector(`.account-nav a[data-tab="${tabId}"]`);
        const selectedTab = document.getElementById(tabId);

        if (selectedLink && selectedTab) {
          selectedLink.parentElement.classList.add('active');
          selectedTab.classList.add('active');
          window.location.hash = tabId;
        }
      }

      tabLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          const tabId = this.getAttribute('data-tab');
          activateTab(tabId);
        });
      });
    });
  </script>
</body>

</html>