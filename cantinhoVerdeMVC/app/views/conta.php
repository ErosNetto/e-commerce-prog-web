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
    <div class="container">
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

            <div class="orders-list">
              <div class="order-card">
                <div class="order-header">
                  <div class="order-header-left">
                    <div class="order-id">#12345</div>
                    <div class="order-date">15/03/2023</div>
                  </div>
                  <div class="order-header-right">
                    <div class="order-status delivered">Entregue</div>
                    <div class="order-total">R$ 189,70</div>
                  </div>
                </div>

                <div class="order-products">
                  <div class="order-product">
                    <img src="img/produto1.jpg" alt="Zamioculca">
                    <div class="product-details">
                      <h4>Zamioculca</h4>
                      <p>Tamanho: Médio | Vaso: Cerâmica</p>
                      <div class="product-price">
                        <span class="quantity">1x</span>
                        <span class="price">R$ 89,90</span>
                      </div>
                    </div>
                  </div>

                  <div class="order-product">
                    <img src="img/produto3.jpg" alt="Suculenta Echeveria">
                    <div class="product-details">
                      <h4>Suculenta Echeveria</h4>
                      <p>Tamanho: Pequeno | Vaso: Plástico</p>
                      <div class="product-price">
                        <span class="quantity">2x</span>
                        <span class="price">R$ 59,80</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="order-actions">
                  <button class="btn-outline">Ver Detalhes</button>
                  <button class="btn">Comprar Novamente</button>
                </div>
              </div>

              <div class="order-card">
                <div class="order-header">
                  <div class="order-header-left">
                    <div class="order-id">#12346</div>
                    <div class="order-date">02/04/2023</div>
                  </div>
                  <div class="order-header-right">
                    <div class="order-status processing">Em Processamento</div>
                    <div class="order-total">R$ 259,80</div>
                  </div>
                </div>

                <div class="order-products">
                  <div class="order-product">
                    <img src="img/produto4.jpg" alt="Costela de Adão">
                    <div class="product-details">
                      <h4>Costela de Adão</h4>
                      <p>Tamanho: Grande | Vaso: Cerâmica</p>
                      <div class="product-price">
                        <span class="quantity">1x</span>
                        <span class="price">R$ 119,90</span>
                      </div>
                    </div>
                  </div>

                  <div class="order-product">
                    <img src="img/produto10.jpg" alt="Vaso Cerâmica">
                    <div class="product-details">
                      <h4>Vaso Cerâmica</h4>
                      <p>Tamanho: Médio | Cor: Terracota</p>
                      <div class="product-price">
                        <span class="quantity">1x</span>
                        <span class="price">R$ 79,90</span>
                      </div>
                    </div>
                  </div>

                  <div class="order-product">
                    <img src="img/produto11.jpg" alt="Kit Jardinagem">
                    <div class="product-details">
                      <h4>Kit Jardinagem</h4>
                      <p>5 peças | Cor: Verde</p>
                      <div class="product-price">
                        <span class="quantity">1x</span>
                        <span class="price">R$ 59,90</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="order-actions">
                  <button class="btn-outline">Ver Detalhes</button>
                  <button class="btn">Rastrear Pedido</button>
                </div>
              </div>

              <div class="order-card">
                <div class="order-header">
                  <div class="order-header-left">
                    <div class="order-id">#12347</div>
                    <div class="order-date">10/02/2023</div>
                  </div>
                  <div class="order-header-right">
                    <div class="order-status delivered">Entregue</div>
                    <div class="order-total">R$ 149,80</div>
                  </div>
                </div>

                <div class="order-products">
                  <div class="order-product">
                    <img src="img/produto8.jpg" alt="Jiboia">
                    <div class="product-details">
                      <h4>Jiboia</h4>
                      <p>Tamanho: Médio | Vaso: Cerâmica</p>
                      <div class="product-price">
                        <span class="quantity">2x</span>
                        <span class="price">R$ 79,80</span>
                      </div>
                    </div>
                  </div>

                  <div class="order-product">
                    <img src="img/produto12.jpg" alt="Substrato Premium">
                    <div class="product-details">
                      <h4>Substrato Premium</h4>
                      <p>Embalagem: 5kg</p>
                      <div class="product-price">
                        <span class="quantity">2x</span>
                        <span class="price">R$ 49,80</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="order-actions">
                  <button class="btn-outline">Ver Detalhes</button>
                  <button class="btn">Comprar Novamente</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php require_once 'partials/footer.php'; ?>

  <script>
    // Funções para a página de conta
    document.addEventListener('DOMContentLoaded', function() {
      // Elementos
      const tabLinks = document.querySelectorAll('.account-nav a[data-tab]');
      const tabContents = document.querySelectorAll('.account-tab');

      // Função para ativar uma aba
      function activateTab(tabId) {
        // Remove todas as classes active
        tabLinks.forEach(link => link.parentElement.classList.remove('active'));
        tabContents.forEach(tab => tab.classList.remove('active'));

        // Ativa a aba selecionada
        const selectedLink = document.querySelector(`.account-nav a[data-tab="${tabId}"]`);
        const selectedTab = document.getElementById(tabId);

        if (selectedLink && selectedTab) {
          selectedLink.parentElement.classList.add('active');
          selectedTab.classList.add('active');
          window.location.hash = tabId;
        }
      }

      // Eventos para os links das abas
      tabLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          const tabId = this.getAttribute('data-tab');
          activateTab(tabId);
        });
      });

      // Verifica o hash na URL ou define 'orders' como padrão
      const defaultTab = 'orders';
      const initialTab = window.location.hash.substring(1) || defaultTab;
      activateTab(initialTab);

      // Eventos para links que redirecionam para abas
      document.querySelectorAll('[data-tab]').forEach(link => {
        if (!link.closest('.account-nav')) {
          link.addEventListener('click', function(e) {
            e.preventDefault();
            const tabId = this.getAttribute('data-tab');
            activateTab(tabId);
          });
        }
      });
    });
  </script>
</body>

</html>