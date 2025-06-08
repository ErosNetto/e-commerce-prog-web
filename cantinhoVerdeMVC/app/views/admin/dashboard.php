<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= APP_NAME ?> | Painel Administrativo</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css" />
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/admin.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body class="admin-body">
  <div class="admin-container">
    <!-- Sidebar -->
    <aside class="admin-sidebar">
      <div class="admin-sidebar-header">
        <div class="admin-logo">
          <img src="../images/logo.png" alt="Plantas Marketplace" />
        </div>
        <button class="admin-sidebar-toggle" id="sidebarToggle">
          <i class="fas fa-bars"></i>
        </button>
      </div>

      <nav class="admin-nav">
        <ul>
          <li class="active">
            <a href="<?= BASE_URL ?>/adminDashboard/dashboard">
              <i class="fas fa-tachometer-alt"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li>
            <a href="<?= BASE_URL ?>/adminProdutos/produtos">
              <i class="fas fa-leaf"></i>
              <span>Produtos</span>
            </a>
          </li>
          <li>
            <a href="<?= BASE_URL ?>/adminCategorias/categorias">
              <i class="fas fa-tags"></i>
              <span>Categorias</span>
            </a>
          </li>
          <li>
            <a href="<?= BASE_URL ?>/adminPedidos/pedidos">
              <i class="fas fa-shopping-cart"></i>
              <span>Pedidos</span>
            </a>
          </li>
          <!-- <li>
            <a href="clientes.html">
              <i class="fas fa-users"></i>
              <span>Clientes</span>
            </a>
          </li>
          <li>
            <a href="configuracoes.html">
              <i class="fas fa-cog"></i>
              <span>Configurações</span>
            </a>
          </li> -->
        </ul>
      </nav>
      <div class="admin-sidebar-footer">
        <a href="login.html" class="admin-logout">
          <i class="fas fa-sign-out-alt"></i>
          <span>Sair</span>
        </a>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="admin-main">
      <!-- Header -->
      <header class="admin-header">
        <div class="admin-header-left">
          <h1>Dashboard</h1>
          <nav class="admin-breadcrumb">
            <a href="dashboard.html">Home</a> / <span>Dashboard</span>
          </nav>
        </div>

        <div class="admin-header-right">
          <div class="admin-profile">
            <button class="admin-profile-btn">
              <span>Admin</span>
              <i class="fas fa-chevron-down"></i>
            </button>
            <div class="admin-profile-dropdown">
              <ul>
                <li>
                  <a href="#"><i class="fas fa-user"></i> Meu Perfil</a>
                </li>
                <li>
                  <a href="#"><i class="fas fa-cog"></i> Configurações</a>
                </li>
                <li>
                  <a href="login.html"><i class="fas fa-sign-out-alt"></i> Sair</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </header>

      <!-- Dashboard Content -->
      <div class="admin-content">
        <!-- Stats Cards -->
        <div class="admin-stats">
          <div class="admin-stat-card">
            <div
              class="stat-card-icon"
              style="background-color: rgba(76, 175, 80, 0.1)">
              <i class="fas fa-shopping-cart" style="color: #4caf50"></i>
            </div>
            <div class="stat-card-info">
              <h3>Vendas Hoje</h3>
              <p class="stat-card-number">R$ 2.580,00</p>
              <p class="stat-card-trend positive">
                <i class="fas fa-arrow-up"></i> 12.5% <span>desde ontem</span>
              </p>
            </div>
          </div>
          <div class="admin-stat-card">
            <div
              class="stat-card-icon"
              style="background-color: rgba(33, 150, 243, 0.1)">
              <i class="fas fa-users" style="color: #2196f3"></i>
            </div>
            <div class="stat-card-info">
              <h3>Novos Clientes</h3>
              <p class="stat-card-number">45</p>
              <p class="stat-card-trend positive">
                <i class="fas fa-arrow-up"></i> 5.2%
                <span>desde a semana passada</span>
              </p>
            </div>
          </div>
          <div class="admin-stat-card">
            <div
              class="stat-card-icon"
              style="background-color: rgba(255, 152, 0, 0.1)">
              <i class="fas fa-box" style="color: #ff9800"></i>
            </div>
            <div class="stat-card-info">
              <h3>Pedidos</h3>
              <p class="stat-card-number">128</p>
              <p class="stat-card-trend positive">
                <i class="fas fa-arrow-up"></i> 8.3%
                <span>desde o mês passado</span>
              </p>
            </div>
          </div>
          <div class="admin-stat-card">
            <div
              class="stat-card-icon"
              style="background-color: rgba(233, 30, 99, 0.1)">
              <i class="fas fa-leaf" style="color: #e91e63"></i>
            </div>
            <div class="stat-card-info">
              <h3>Produtos</h3>
              <p class="stat-card-number">85</p>
              <p class="stat-card-trend negative">
                <i class="fas fa-arrow-down"></i> 2.4%
                <span>estoque baixo</span>
              </p>
            </div>
          </div>
        </div>

        <!-- Recent Orders & Sales Chart -->
        <div class="admin-dashboard-row">
          <div class="admin-dashboard-col">
            <div class="admin-card">
              <div class="admin-card-header">
                <h2>Pedidos Recentes</h2>
                <a href="pedidos.html" class="admin-btn admin-btn-sm">Ver Todos</a>
              </div>
              <div class="admin-card-body">
                <div class="admin-table-responsive">
                  <table class="admin-table">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Produto</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>#ORD-0025</td>
                        <td>Maria Silva</td>
                        <td>Zamioculca</td>
                        <td>15/04/2023</td>
                        <td>
                          <span class="status-badge completed">Entregue</span>
                        </td>
                        <td>R$ 89,90</td>
                      </tr>
                      <tr>
                        <td>#ORD-0024</td>
                        <td>João Santos</td>
                        <td>Espada de São Jorge</td>
                        <td>15/04/2023</td>
                        <td>
                          <span class="status-badge processing">Em Processamento</span>
                        </td>
                        <td>R$ 64,50</td>
                      </tr>
                      <tr>
                        <td>#ORD-0023</td>
                        <td>Ana Oliveira</td>
                        <td>Suculenta Echeveria</td>
                        <td>14/04/2023</td>
                        <td>
                          <span class="status-badge shipped">Enviado</span>
                        </td>
                        <td>R$ 29,90</td>
                      </tr>
                      <tr>
                        <td>#ORD-0022</td>
                        <td>Carlos Pereira</td>
                        <td>Cacto Mandacaru</td>
                        <td>14/04/2023</td>
                        <td>
                          <span class="status-badge completed">Entregue</span>
                        </td>
                        <td>R$ 39,90</td>
                      </tr>
                      <tr>
                        <td>#ORD-0021</td>
                        <td>Fernanda Lima</td>
                        <td>Orquídea Phalaenopsis</td>
                        <td>13/04/2023</td>
                        <td>
                          <span class="status-badge cancelled">Cancelado</span>
                        </td>
                        <td>R$ 96,00</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script src="../js/admin.js"></script>
  <script>
    // Toggle sidebar
    document
      .getElementById("sidebarToggle")
      .addEventListener("click", function() {
        document
          .querySelector(".admin-container")
          .classList.toggle("sidebar-collapsed");
      });

    // Toggle dropdowns
    const dropdownToggles = document.querySelectorAll(
      ".admin-notification-btn, .admin-profile-btn"
    );
    dropdownToggles.forEach((toggle) => {
      toggle.addEventListener("click", function(e) {
        e.stopPropagation();
        const dropdown = this.nextElementSibling;
        dropdown.classList.toggle("show");

        // Fechar outros dropdowns
        dropdownToggles.forEach((otherToggle) => {
          if (otherToggle !== toggle) {
            otherToggle.nextElementSibling.classList.remove("show");
          }
        });
      });
    });

    // Fechar dropdowns ao clicar fora
    document.addEventListener("click", function() {
      document
        .querySelectorAll(
          ".admin-notification-dropdown, .admin-profile-dropdown"
        )
        .forEach((dropdown) => {
          dropdown.classList.remove("show");
        });
    });
  </script>
</body>

</html>