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
            <a href="dashboard.html">Home</a> / <span>Pedidos</span>
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
            <div class="date-filter">
              <label>Período:</label>
              <input type="date" id="startDate" name="startDate" />
              <span>até</span>
              <input type="date" id="endDate" name="endDate" />
              <button
                class="admin-btn admin-btn-secondary"
                id="filterDateBtn">
                Filtrar
              </button>
            </div>
          </div>

          <div class="admin-card-body">
            <!-- <div class="admin-filters">

              <div class="admin-filter-group">
                <select id="statusFilter">
                  <option value="">Todos os Status</option>
                  <option value="aguardando_pagamento">
                    Aguardando Pagamento
                  </option>
                  <option value="pagamento_confirmado">
                    Pagamento Confirmado
                  </option>
                  <option value="em_processamento">Em Processamento</option>
                  <option value="enviado">Enviado</option>
                  <option value="entregue">Entregue</option>
                  <option value="cancelado">Cancelado</option>
                </select>
              </div>

              <div class="admin-filter-group">
                <select id="paymentFilter">
                  <option value="">Todos os Pagamentos</option>
                  <option value="cartao_credito">Cartão de Crédito</option>
                  <option value="boleto">Boleto</option>
                  <option value="pix">PIX</option>
                  <option value="transferencia">Transferência</option>
                </select>
              </div>

              <button class="admin-btn admin-btn-secondary" id="filterButton">
                <i class="fas fa-filter"></i> Filtrar
              </button>
              <button class="admin-btn admin-btn-secondary" id="exportButton">
                <i class="fas fa-file-export"></i> Exportar
              </button>
            </div> -->

            <div class="admin-table-responsive">
              <table class="admin-table">
                <thead>
                  <tr>
                    <th>Pedido</th>
                    <th>Cliente</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Pagamento</th>
                    <th>Total</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>#ORD-0025</td>
                    <td>Maria Silva</td>
                    <td>15/04/2023</td>
                    <td>
                      <span class="status-badge completed">Entregue</span>
                    </td>
                    <td>Cartão de Crédito</td>
                    <td>R$ 89,90</td>
                    <td>
                      <div class="action-buttons">
                        <button
                          class="action-btn view-btn"
                          title="Visualizar"
                          data-id="25">
                          <i class="fas fa-eye"></i>
                        </button>
                        <button
                          class="action-btn edit-btn"
                          title="Editar"
                          data-id="25">
                          <i class="fas fa-edit"></i>
                        </button>
                        <button
                          class="action-btn invoice-btn"
                          title="Nota Fiscal"
                          data-id="25">
                          <i class="fas fa-file-invoice"></i>
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
              <div class="order-info-item">
                <span class="label">Status:</span>
                <span class="value">
                  <select id="orderStatus">
                    <option value="aguardando_pagamento">
                      Aguardando Pagamento
                    </option>
                    <option value="pagamento_confirmado">
                      Pagamento Confirmado
                    </option>
                    <option value="em_processamento">Em Processamento</option>
                    <option value="enviado">Enviado</option>
                    <option value="entregue" selected>Entregue</option>
                    <option value="cancelado">Cancelado</option>
                  </select>
                </span>
              </div>
              <div class="order-info-item">
                <span class="label">Pagamento:</span>
                <span class="value">Cartão de Crédito</span>
              </div>
            </div>
            <div class="order-actions">
              <button class="admin-btn admin-btn-secondary">
                <i class="fas fa-print"></i> Imprimir
              </button>
              <button class="admin-btn admin-btn-secondary">
                <i class="fas fa-file-invoice"></i> Nota Fiscal
              </button>
              <button
                class="admin-btn admin-btn-primary"
                id="saveOrderStatus">
                <i class="fas fa-save"></i> Salvar Status
              </button>
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
              <h4>Endereço de Entrega</h4>
              <div class="order-address-info">
                <p>Maria Silva</p>
                <p>Rua das Flores, 123 - Apto 45</p>
                <p>Jardim Primavera</p>
                <p>São Paulo - SP</p>
                <p>CEP: 01234-567</p>
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
                        <strong>Frete:</strong>
                      </td>
                      <td>R$ 0,00</td>
                    </tr>
                    <tr>
                      <td colspan="3" class="text-right">
                        <strong>Desconto:</strong>
                      </td>
                      <td>R$ 0,00</td>
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

            <div class="order-details-section">
              <h4>Histórico do Pedido</h4>
              <ul class="order-history">
                <li>
                  <div class="order-history-date">15/04/2023 14:30</div>
                  <div class="order-history-status">Pedido realizado</div>
                  <div class="order-history-comment">
                    Pedido #ORD-0025 criado pelo cliente
                  </div>
                </li>
                <li>
                  <div class="order-history-date">15/04/2023 14:35</div>
                  <div class="order-history-status">Pagamento confirmado</div>
                  <div class="order-history-comment">
                    Pagamento aprovado via Cartão de Crédito
                  </div>
                </li>
                <li>
                  <div class="order-history-date">16/04/2023 09:15</div>
                  <div class="order-history-status">Em processamento</div>
                  <div class="order-history-comment">
                    Pedido em preparação para envio
                  </div>
                </li>
                <li>
                  <div class="order-history-date">16/04/2023 15:40</div>
                  <div class="order-history-status">Enviado</div>
                  <div class="order-history-comment">
                    Pedido enviado via Correios. Código de rastreio:
                    BR1234567890
                  </div>
                </li>
                <li>
                  <div class="order-history-date">18/04/2023 10:20</div>
                  <div class="order-history-status">Entregue</div>
                  <div class="order-history-comment">
                    Pedido entregue ao cliente
                  </div>
                </li>
              </ul>
            </div>

            <div class="order-details-section">
              <h4>Adicionar Comentário</h4>
              <div class="order-comment-form">
                <textarea
                  id="orderComment"
                  rows="3"
                  placeholder="Digite um comentário sobre este pedido..."></textarea>
                <button
                  class="admin-btn admin-btn-primary"
                  id="addCommentBtn">
                  <i class="fas fa-plus"></i> Adicionar Comentário
                </button>
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

    // Order Details Modal
    const orderModal = document.getElementById("orderModal");

    // View Order Details
    const viewButtons = document.querySelectorAll(".view-btn");
    viewButtons.forEach((button) => {
      button.addEventListener("click", function() {
        const orderId = this.getAttribute("data-id");
        // Em um ambiente real, você faria uma requisição AJAX para obter os detalhes do pedido
        orderModal.classList.add("show");
      });
    });

    // Close Modal
    const closeButtons = document.querySelectorAll(".admin-modal-close");
    closeButtons.forEach((button) => {
      button.addEventListener("click", function() {
        document.querySelectorAll(".admin-modal").forEach((modal) => {
          modal.classList.remove("show");
        });
      });
    });


    // Add Comment
    document
      .getElementById("addCommentBtn")
      .addEventListener("click", function() {
        const comment = document.getElementById("orderComment").value;
        if (!comment.trim()) {
          alert("Por favor, digite um comentário");
          return;
        }

        // Em um ambiente real, você faria uma requisição AJAX para adicionar o comentário
        alert("Comentário adicionado com sucesso!");
        document.getElementById("orderComment").value = "";

        // Simulando a adição do comentário ao histórico
        const orderHistory = document.querySelector(".order-history");
        const now = new Date();
        const formattedDate = `${now
              .getDate()
              .toString()
              .padStart(2, "0")}/${(now.getMonth() + 1)
              .toString()
              .padStart(2, "0")}/${now.getFullYear()} ${now
              .getHours()
              .toString()
              .padStart(2, "0")}:${now
              .getMinutes()
              .toString()
              .padStart(2, "0")}`;

        const newHistoryItem = document.createElement("li");
        newHistoryItem.innerHTML = `
                    <div class="order-history-date">${formattedDate}</div>
                    <div class="order-history-status">Comentário</div>
                    <div class="order-history-comment">${comment}</div>
                `;

        orderHistory.appendChild(newHistoryItem);
      });

    // Export Button
    document
      .getElementById("exportButton")
      .addEventListener("click", function() {
        alert(
          "Exportando pedidos... Em um ambiente real, isso geraria um arquivo CSV ou Excel."
        );
      });

    // Date Filter
    document
      .getElementById("filterDateBtn")
      .addEventListener("click", function() {
        const startDate = document.getElementById("startDate").value;
        const endDate = document.getElementById("endDate").value;

        if (!startDate || !endDate) {
          alert("Por favor, selecione um período completo");
          return;
        }

        // Em um ambiente real, você faria uma requisição AJAX para filtrar os pedidos por data
        alert(`Filtrando pedidos de ${startDate} até ${endDate}`);
      });
  </script>
</body>

</html>