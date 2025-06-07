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
            <h3>Maria Silva</h3>
            <p>maria.silva@email.com</p>
          </div>

          <nav class="account-nav">
            <ul>
              <li class="active"><a href="#dashboard" data-tab="dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
              <li><a href="#orders" data-tab="orders"><i class="fas fa-shopping-bag"></i> Meus Pedidos</a></li>
              <li><a href="#addresses" data-tab="addresses"><i class="fas fa-map-marker-alt"></i> Endereços</a></li>
              <!-- <li><a href="#wishlist" data-tab="wishlist"><i class="fas fa-heart"></i> Lista de Desejos</a></li> -->
              <!-- <li><a href="#reviews" data-tab="reviews"><i class="fas fa-star"></i> Avaliações</a></li> -->
              <li><a href="#profile" data-tab="profile"><i class="fas fa-user-edit"></i> Editar Perfil</a></li>
              <li><a href="#password" data-tab="password"><i class="fas fa-lock"></i> Alterar Senha</a></li>
              <li><a href="index.html"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
            </ul>
          </nav>
        </div>

        <div class="account-content">
          <!-- Dashboard Tab -->
          <div class="account-tab active" id="dashboard">
            <h2>Dashboard</h2>

            <div class="dashboard-welcome">
              <p>Olá <strong>Maria</strong>, bem-vinda à sua conta. Aqui você pode gerenciar seus pedidos, endereços, lista de desejos e muito mais.</p>
            </div>

            <div class="dashboard-stats">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="stat-info">
                  <h3>5</h3>
                  <p>Pedidos</p>
                </div>
              </div>

              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-heart"></i>
                </div>
                <div class="stat-info">
                  <h3>12</h3>
                  <p>Lista de Desejos</p>
                </div>
              </div>

              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-star"></i>
                </div>
                <div class="stat-info">
                  <h3>8</h3>
                  <p>Avaliações</p>
                </div>
              </div>

              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="stat-info">
                  <h3>2</h3>
                  <p>Endereços</p>
                </div>
              </div>
            </div>

            <div class="dashboard-sections">
              <div class="dashboard-section">
                <h3>Pedidos Recentes</h3>
                <div class="recent-orders">
                  <div class="order-item">
                    <div class="order-info">
                      <span class="order-id">#12345</span>
                      <span class="order-date">15/03/2023</span>
                      <span class="order-status delivered">Entregue</span>
                    </div>
                    <div class="order-total">
                      <span>R$ 189,70</span>
                      <a href="#orders" class="btn-small" data-tab="orders">Ver Detalhes</a>
                    </div>
                  </div>

                  <div class="order-item">
                    <div class="order-info">
                      <span class="order-id">#12346</span>
                      <span class="order-date">02/04/2023</span>
                      <span class="order-status processing">Em Processamento</span>
                    </div>
                    <div class="order-total">
                      <span>R$ 259,80</span>
                      <a href="#orders" class="btn-small" data-tab="orders">Ver Detalhes</a>
                    </div>
                  </div>
                </div>
              </div>

              <!-- <div class="dashboard-section">
                <h3>Lista de Desejos</h3>
                <div class="wishlist-preview">
                  <div class="product-card small">
                    <div class="product-image">
                      <img src="img/produto9.jpg" alt="Orquídea Phalaenopsis">
                    </div>
                    <div class="product-info">
                      <h4>Orquídea Phalaenopsis</h4>
                      <div class="product-price">
                        <span class="price">R$ 129,90</span>
                      </div>
                      <button class="btn-add-cart small">Adicionar ao Carrinho</button>
                    </div>
                  </div>

                  <div class="product-card small">
                    <div class="product-image">
                      <img src="img/produto10.jpg" alt="Vaso Cerâmica">
                    </div>
                    <div class="product-info">
                      <h4>Vaso Cerâmica</h4>
                      <div class="product-price">
                        <span class="price">R$ 79,90</span>
                      </div>
                      <button class="btn-add-cart small">Adicionar ao Carrinho</button>
                    </div>
                  </div>

                  <div class="product-card small">
                    <div class="product-image">
                      <img src="img/produto7.jpg" alt="Lírio da Paz">
                    </div>
                    <div class="product-info">
                      <h4>Lírio da Paz</h4>
                      <div class="product-price">
                        <span class="price">R$ 59,90</span>
                      </div>
                      <button class="btn-add-cart small">Adicionar ao Carrinho</button>
                    </div>
                  </div>
                </div>
                <div class="view-all">
                  <a href="#wishlist" class="btn-outline" data-tab="wishlist">Ver Lista Completa</a>
                </div>
              </div> -->
            </div>
          </div>

          <!-- Orders Tab -->
          <div class="account-tab" id="orders">
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

          <!-- Addresses Tab -->
          <div class="account-tab" id="addresses">
            <h2>Meus Endereços</h2>

            <div class="addresses-container">
              <div class="address-card">
                <div class="address-badge default">Principal</div>
                <h3>Casa</h3>
                <p>Maria Silva</p>
                <p>Avenida Paulista, 1000, Apto 123</p>
                <p>Bela Vista</p>
                <p>São Paulo - SP</p>
                <p>CEP: 01310-100</p>
                <p>Tel: (11) 99999-9999</p>
                <div class="address-actions">
                  <button class="btn-outline">Editar</button>
                </div>
              </div>

              <div class="address-card">
                <h3>Trabalho</h3>
                <p>Maria Silva</p>
                <p>Rua Augusta, 500, Sala 45</p>
                <p>Consolação</p>
                <p>São Paulo - SP</p>
                <p>CEP: 01304-000</p>
                <p>Tel: (11) 98888-8888</p>
                <div class="address-actions">
                  <button class="btn-outline">Editar</button>
                  <button class="btn-outline delete">Excluir</button>
                  <button class="btn">Definir como Principal</button>
                </div>
              </div>

              <div class="address-card add-new">
                <div class="add-address">
                  <i class="fas fa-plus-circle"></i>
                  <h3>Adicionar Novo Endereço</h3>
                </div>
              </div>
            </div>
          </div>

          <!-- Wishlist Tab -->
          <!-- <div class="account-tab" id="wishlist">
            <h2>Lista de Desejos</h2>

            <div class="wishlist-container">
              <div class="product-grid">
                <div class="product-card">
                  <div class="product-image">
                    <img src="img/produto9.jpg" alt="Orquídea Phalaenopsis">
                    <button class="remove-wishlist"><i class="fas fa-times"></i></button>
                  </div>
                  <div class="product-info">
                    <h3>Orquídea Phalaenopsis</h3>
                    <p class="product-description">Orquídea com flores duradouras</p>
                    <div class="product-price">
                      <span class="price">R$ 129,90</span>
                    </div>
                    <button class="btn-add-cart">Adicionar ao Carrinho</button>
                  </div>
                </div>

                <div class="product-card">
                  <div class="product-image">
                    <img src="img/produto10.jpg" alt="Vaso Cerâmica">
                    <button class="remove-wishlist"><i class="fas fa-times"></i></button>
                  </div>
                  <div class="product-info">
                    <h3>Vaso Cerâmica</h3>
                    <p class="product-description">Vaso decorativo em cerâmica</p>
                    <div class="product-price">
                      <span class="price">R$ 79,90</span>
                    </div>
                    <button class="btn-add-cart">Adicionar ao Carrinho</button>
                  </div>
                </div>

                <div class="product-card">
                  <div class="product-image">
                    <img src="img/produto7.jpg" alt="Lírio da Paz">
                    <button class="remove-wishlist"><i class="fas fa-times"></i></button>
                  </div>
                  <div class="product-info">
                    <h3>Lírio da Paz</h3>
                    <p class="product-description">Planta com flores brancas elegantes</p>
                    <div class="product-price">
                      <span class="price">R$ 59,90</span>
                    </div>
                    <button class="btn-add-cart">Adicionar ao Carrinho</button>
                  </div>
                </div>

                <div class="product-card">
                  <div class="product-image">
                    <img src="img/produto2.jpg" alt="Espada de São Jorge">
                    <button class="remove-wishlist"><i class="fas fa-times"></i></button>
                  </div>
                  <div class="product-info">
                    <h3>Espada de São Jorge</h3>
                    <p class="product-description">Planta purificadora de ar e de baixa manutenção</p>
                    <div class="product-price">
                      <span class="price">R$ 69,90</span>
                    </div>
                    <button class="btn-add-cart">Adicionar ao Carrinho</button>
                  </div>
                </div>
              </div>
            </div>
          </div> -->

          <!-- Reviews Tab -->
          <!-- <div class="account-tab" id="reviews">
            <h2>Minhas Avaliações</h2>

            <div class="reviews-container">
              <div class="review-card">
                <div class="review-product">
                  <img src="img/produto1.jpg" alt="Zamioculca">
                  <div class="product-info">
                    <h3>Zamioculca</h3>
                    <div class="stars">
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                    </div>
                  </div>
                </div>
                <div class="review-content">
                  <h4>Planta perfeita para quem não tem tempo!</h4>
                  <p>Comprei essa Zamioculca há 3 meses e estou impressionada com a resistência dela. Esqueço de regar por semanas e ela continua linda e saudável. As folhas são brilhantes e a planta chegou muito bem embalada. Recomendo para quem quer ter plantas mas não tem muito tempo para cuidar.</p>
                </div>
                <div class="review-meta">
                  <span class="review-date">12/03/2023</span>
                  <div class="review-actions">
                    <button class="btn-outline">Editar</button>
                    <button class="btn-outline delete">Excluir</button>
                  </div>
                </div>
              </div>

              <div class="review-card">
                <div class="review-product">
                  <img src="img/produto4.jpg" alt="Costela de Adão">
                  <div class="product-info">
                    <h3>Costela de Adão</h3>
                    <div class="stars">
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="far fa-star"></i>
                    </div>
                  </div>
                </div>
                <div class="review-content">
                  <h4>Linda planta, mas precisa de espaço</h4>
                  <p>A Costela de Adão é uma planta linda e chegou em perfeito estado. As folhas são grandes e bem recortadas. Só não dei 5 estrelas porque ela cresceu mais rápido do que eu esperava e acabou ficando grande demais para o espaço que eu tinha planejado. Mesmo assim, estou satisfeita com a compra.</p>
                </div>
                <div class="review-meta">
                  <span class="review-date">05/04/2023</span>
                  <div class="review-actions">
                    <button class="btn-outline">Editar</button>
                    <button class="btn-outline delete">Excluir</button>
                  </div>
                </div>
              </div>
            </div>
          </div> -->

          <!-- Profile Tab -->
          <div class="account-tab" id="profile">
            <h2>Editar Perfil</h2>

            <form class="profile-form">
              <div class="form-section">
                <div class="form-row">
                  <div class="form-group">
                    <label for="profile-name">Nome*</label>
                    <input type="text" id="profile-name" value="Maria" required>
                  </div>
                  <div class="form-group">
                    <label for="profile-lastname">Sobrenome*</label>
                    <input type="text" id="profile-lastname" value="Silva" required>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group">
                    <label for="profile-email">E-mail*</label>
                    <input type="email" id="profile-email" value="maria.silva@email.com" required>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group">
                    <label for="profile-cpf">CPF*</label>
                    <input type="text" id="profile-cpf" value="123.456.789-00" required>
                  </div>
                  <div class="form-group">
                    <label for="profile-phone">Telefone*</label>
                    <input type="tel" id="profile-phone" value="(11) 99999-9999" required>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group">
                    <label for="profile-birth">Data de Nascimento</label>
                    <input type="date" id="profile-birth" value="1990-05-15">
                  </div>
                  <div class="form-group">
                    <label for="profile-gender">Gênero</label>
                    <select id="profile-gender">
                      <option value="">Selecione</option>
                      <option value="female" selected>Feminino</option>
                      <option value="male">Masculino</option>
                      <option value="other">Outro</option>
                      <option value="not-inform">Prefiro não informar</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-section">
                <h3>Foto de Perfil</h3>
                <div class="profile-photo">
                  <div class="current-photo">
                    <img src="img/user-avatar.jpg" alt="Foto de Perfil">
                  </div>
                  <div class="photo-upload">
                    <input type="file" id="profile-photo" accept="image/*">
                    <label for="profile-photo" class="btn-outline">Alterar Foto</label>
                  </div>
                </div>
              </div>

              <div class="form-actions">
                <button type="button" class="btn-outline">Cancelar</button>
                <button type="submit" class="btn">Salvar Alterações</button>
              </div>
            </form>
          </div>

          <!-- Password Tab -->
          <div class="account-tab" id="password">
            <h2>Alterar Senha</h2>

            <form class="password-form">
              <div class="form-section">
                <div class="form-row">
                  <div class="form-group">
                    <label for="current-password">Senha Atual*</label>
                    <input type="password" id="current-password" required>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group">
                    <label for="new-password">Nova Senha*</label>
                    <input type="password" id="new-password" required>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group">
                    <label for="confirm-password">Confirmar Nova Senha*</label>
                    <input type="password" id="confirm-password" required>
                  </div>
                </div>

                <div class="password-requirements">
                  <h4>Requisitos de Senha:</h4>
                  <ul>
                    <li>Mínimo de 8 caracteres</li>
                    <li>Pelo menos uma letra maiúscula</li>
                    <li>Pelo menos uma letra minúscula</li>
                    <li>Pelo menos um número</li>
                    <li>Pelo menos um caractere especial</li>
                  </ul>
                </div>
              </div>

              <div class="form-actions">
                <button type="button" class="btn-outline">Cancelar</button>
                <button type="submit" class="btn">Alterar Senha</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php require_once 'partials/footer.php'; ?>

  <script>
    // Funções para a página de conta
    document.addEventListener('DOMContentLoaded', function() {
      // Navegação entre as abas
      const tabLinks = document.querySelectorAll('.account-nav a');
      const tabContents = document.querySelectorAll('.account-tab');

      tabLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          e.preventDefault();

          const tabId = this.getAttribute('data-tab');

          // Remove active class from all links and tabs
          tabLinks.forEach(link => link.parentElement.classList.remove('active'));
          tabContents.forEach(tab => tab.classList.remove('active'));

          // Add active class to current link and tab
          this.parentElement.classList.add('active');
          document.getElementById(tabId).classList.add('active');

          // Update URL hash
          window.location.hash = tabId;
        });
      });

      // Check for hash in URL on page load
      if (window.location.hash) {
        const hash = window.location.hash.substring(1);
        const tabLink = document.querySelector(`.account-nav a[data-tab="${hash}"]`);

        if (tabLink) {
          tabLink.click();
        }
      }

      // Links from dashboard to other tabs
      const dashboardLinks = document.querySelectorAll('.dashboard-section a[data-tab]');

      dashboardLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          e.preventDefault();

          const tabId = this.getAttribute('data-tab');
          const tabLink = document.querySelector(`.account-nav a[data-tab="${tabId}"]`);

          if (tabLink) {
            tabLink.click();
          }
        });
      });
    });
  </script>
</body>

</html>