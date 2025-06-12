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
          <li class="active">
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
            <a href="<?= BASE_URL ?>">Home</a> / <span>Pedidos</span>
          </nav>
        </div>

        <div class="admin-header-right">
          <h3><?= htmlspecialchars($usuario["name"]) ?></h3>
        </div>
      </header>

      <!-- Orders Content -->
      <div class="admin-content">
        <div class="admin-card">
          <div class="admin-card-header">
            <h2>Lista de Pedidos</h2>
          </div>

          <div class="admin-card-body">
            <div class="admin-table-responsive">
              <table class="admin-table">
                <thead>
                  <tr>
                    <th>#ORD</th>
                    <th>Cliente</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Data do Pedido</th>
                    <th>Total (R$)</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data['pedidos'] as $pedido): ?>
                    <tr>
                      <td>#ORD-<?= htmlspecialchars($pedido['pedido_id']) ?></td>
                      <td><?= htmlspecialchars($pedido['cliente_nome']) ?></td>
                      <td><?= htmlspecialchars($pedido['email']) ?></td>
                      <td><?= htmlspecialchars($pedido['telefone'] ?? 'Não informado') ?></td>
                      <td><?= isset($pedido['data_pedido']) ? date('d/m/Y H:i', strtotime($pedido['data_pedido'])) : 'Data não disponível' ?></td>
                      <td>R$ <?= number_format($pedido['total'], 2, ',', '.') ?></td>
                      <td>
                        <a
                          class="action-btn view-btn open-order-modal"
                          href="#"
                          data-id="<?= $pedido['pedido_id'] ?>">
                          <i class="fas fa-eye"></i>
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>

              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <!-- Order Details Modal -->
  <div class="admin-modal" id="orderModal">
    <div class="admin-modal-content admin-modal-lg">
      <div class="admin-modal-header">
        <h3>Detalhes do Pedido #ORD-0025</h3>
        <button class="admin-modal-close">&times;</button>
      </div>
      <div class="admin-modal-body">
        <div class="order-details">
          <div class="order-details-header">
            <div class="order-info">
              <div class="order-info-item">
                <span class="label">Data do Pedido:</span>
                <span class="value">15/04/2023 14:30</span>
              </div>

            </div>
          </div>

          <div class="order-details-content">
            <div class="order-details-section">
              <h4>Cliente</h4>
              <div class="order-customer-info">
                <p><strong>Nome:</strong> Maria Silva</p>
                <p><strong>Email:</strong> maria.silva@email.com</p>
                <p><strong>Telefone:</strong> (11) 98765-4321</p>
                <p><strong>CPF:</strong> 123.456.789-00</p>
              </div>
            </div>

            <div class="order-details-section">
              <h4>Itens do Pedido</h4>
              <div class="admin-table-responsive">
                <table class="admin-table">
                  <thead>
                    <tr>
                      <th>Produto</th>
                      <th>Quantidade</th>
                      <th>Preço Unitário</th>
                      <th>Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="order-product">
                          <img
                            src="../images/products/planta1.jpg"
                            alt="Zamioculca"
                            class="product-thumbnail" />
                          <div>
                            <h5>Zamioculca</h5>
                            <p>SKU: PLT-ZAM-001</p>
                          </div>
                        </div>
                      </td>
                      <td>1</td>
                      <td>R$ 89,90</td>
                      <td>R$ 89,90</td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="3" class="text-right">
                        <strong>Subtotal:</strong>
                      </td>
                      <td>R$ 89,90</td>
                    </tr>
                    <tr>
                      <td colspan="3" class="text-right">
                        <strong>Total:</strong>
                      </td>
                      <td>R$ 89,90</td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
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

    const orderModal = document.getElementById("orderModal");
    const modalClose = document.querySelector(".admin-modal-close");

    const viewButtons = document.querySelectorAll(".view-btn");
    viewButtons.forEach((button) => {
      button.addEventListener("click", async function(e) {
        e.preventDefault();
        const orderId = this.getAttribute("data-id");

        try {
          const response = await fetch(`<?= BASE_URL ?>/adminPedidos/detalhes/${orderId}`);
          const pedido = await response.json();

          // Preencher os dados no modal
          document.querySelector("#orderModal h3").textContent = `Detalhes do Pedido #ORD-${pedido.pedido_id}`;

          const customerInfo = document.querySelector(".order-customer-info");
          customerInfo.innerHTML = `
        <p><strong>Nome:</strong> ${pedido.cliente_nome}</p>
        <p><strong>Email:</strong> ${pedido.email}</p>
        <p><strong>Telefone:</strong> ${pedido.telefone ?? 'Não informado'}</p>
        <p><strong>CPF:</strong> ${pedido.cpf ?? 'Não informado'}</p>
      `;

          const tbody = document.querySelector("#orderModal tbody");
          tbody.innerHTML = pedido.itens.map(item => `
        <tr>
          <td>
            <div class="order-product">
              <img src="<?= BASE_URL ?>/images/products/${item.imagem}" alt="${item.nome_produto}" class="product-thumbnail" />
              <div>
                <h5>${item.nome_produto}</h5>
                <p>SKU: ${item.sku}</p>
              </div>
            </div>
          </td>
          <td>${item.quantidade}</td>
          <td>R$ ${item.preco_unitario.toFixed(2).replace('.', ',')}</td>
          <td>R$ ${item.subtotal.toFixed(2).replace('.', ',')}</td>
        </tr>
      `).join('');

          // Mostrar modal
          orderModal.classList.add("show");
        } catch (error) {
          alert("Erro ao carregar os detalhes do pedido.");
          console.error(error);
        }
      });
    });

    // Fechar modal
    modalClose.addEventListener("click", function() {
      orderModal.classList.remove("show");
    });
  </script>
</body>

</html>