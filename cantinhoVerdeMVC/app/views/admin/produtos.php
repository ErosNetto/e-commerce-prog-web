<?php
require_once '../app/helpers/Auth.php';
$usuario = Auth::getUser();
?>

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
          <h1>Cantinho<span>Verde</span></h1>
        </div>
        <button class="admin-sidebar-toggle" id="sidebarToggle">
          <i class="fas fa-bars"></i>
        </button>
      </div>

      <nav class="admin-nav">
        <ul>
          <li>
            <a href="<?= BASE_URL ?>/adminDashboard/dashboard">
              <i class="fas fa-tachometer-alt"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li class="active">
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
        </ul>
      </nav>
      <div class="admin-sidebar-footer">
        <a href="<?= BASE_URL ?>/usuario/logout" class="admin-logout">
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
            <a href="dashboard.html">Home</a> / <span>Produtos</span>
          </nav>
        </div>

        <div class="admin-header-right">
          <h3><?= htmlspecialchars($usuario["name"]) ?></h3>
        </div>
      </header>

      <!-- Products Content -->
      <div class="admin-content">
        <div class="admin-card">
          <div class="admin-card-header">
            <h2>Lista de Produtos</h2>
            <a
              href="produto-adicionar.html"
              class="admin-btn admin-btn-primary">
              <i class="fas fa-plus"></i> Adicionar Produto
            </a>
          </div>
          <div class="admin-card-body">
            <!-- <div class="admin-filters">
              <div class="admin-filter-group">
                <select id="categoryFilter">
                  <option value="">Todas as Categorias</option>
                  <option value="interior">Plantas de Interior</option>
                  <option value="exterior">Plantas de Exterior</option>
                  <option value="suculentas">Suculentas</option>
                  <option value="cactos">Cactos</option>
                  <option value="flores">Flores</option>
                </select>
              </div>
              <div class="admin-filter-group">
                <select id="statusFilter">
                  <option value="">Todos os Status</option>
                  <option value="instock">Em Estoque</option>
                  <option value="lowstock">Estoque Baixo</option>
                  <option value="outofstock">Fora de Estoque</option>
                </select>
              </div>
              <button class="admin-btn admin-btn-secondary" id="filterButton">
                <i class="fas fa-filter"></i> Filtrar
              </button>
            </div> -->

            <div class="admin-table-responsive">
              <table class="admin-table">
                <thead>
                  <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Status</th>
                    <th>Ações</th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td>
                      <img
                        src="../images/products/planta1.jpg"
                        alt="Zamioculca"
                        class="product-thumbnail" />
                    </td>
                    <td>Zamioculca</td>
                    <td>Planta de Interior</td>
                    <td>R$ 89,90</td>
                    <td>15</td>
                    <td>
                      <span class="status-badge instock">Em Estoque</span>
                    </td>
                    <td>
                      <div class="action-buttons">
                        <a
                          href="produto-editar.html?id=1"
                          class="action-btn edit-btn"
                          title="Editar">
                          <i class="fas fa-edit"></i>
                        </a>
                        <button
                          class="action-btn delete-btn"
                          title="Excluir"
                          data-id="1">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                        <button
                          class="action-btn view-btn"
                          title="Visualizar"
                          data-id="1">
                          <i class="fas fa-eye"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="admin-table-actions">
              <div class="pagination">
                <button class="pagination-btn" disabled>
                  <i class="fas fa-chevron-left"></i>
                </button>
                <button class="pagination-btn active">1</button>
                <button class="pagination-btn">2</button>
                <button class="pagination-btn">
                  <i class="fas fa-chevron-right"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <!-- Delete Confirmation Modal -->
  <div class="admin-modal" id="deleteModal">
    <div class="admin-modal-content">
      <div class="admin-modal-header">
        <h3>Confirmar Exclusão</h3>
        <button class="admin-modal-close">&times;</button>
      </div>
      <div class="admin-modal-body">
        <p>
          Tem certeza que deseja excluir este produto? Esta ação não pode ser
          desfeita.
        </p>
      </div>
      <div class="admin-modal-footer">
        <button class="admin-btn admin-btn-secondary admin-modal-cancel">
          Cancelar
        </button>
        <button class="admin-btn admin-btn-danger" id="confirmDelete">
          Sim, Excluir
        </button>
      </div>
    </div>
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

    // Close Modal
    const closeButtons = document.querySelectorAll(
      ".admin-modal-close, .admin-modal-cancel"
    );
    closeButtons.forEach((button) => {
      button.addEventListener("click", function() {
        document.querySelectorAll(".admin-modal").forEach((modal) => {
          modal.classList.remove("show");
        });
      });
    });

    // Delete Product
    const deleteModal = document.getElementById("deleteModal");
    const deleteButtons = document.querySelectorAll(".delete-btn");

    deleteButtons.forEach((button) => {
      button.addEventListener("click", function() {
        deleteModal.classList.add("show");
      });
    });
  </script>
</body>

</html>