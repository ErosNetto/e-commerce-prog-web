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
          <li class="active">
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
            <a href="<?= BASE_URL ?>">Home</a> / <span>Categorias</span>
          </nav>
        </div>

        <div class="admin-header-right">
          <h3><?= htmlspecialchars($usuario["name"]) ?></h3>
        </div>
      </header>

      <!-- Categories Content -->
      <div class="admin-content">
        <?php if (isset($_SESSION['success'])): ?>
          <div class="alert alert-success">
            <?= $_SESSION['success'] ?>
            <?php unset($_SESSION['success']); ?>
          </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
          <div class="alert alert-danger">
            <?= $_SESSION['error'] ?>
            <?php unset($_SESSION['error']); ?>
          </div>
        <?php endif; ?>

        <div class="admin-card">
          <div class="admin-card-header">
            <h2>Lista de Categorias</h2>
            <button class="admin-btn admin-btn-primary" id="addCategoryBtn">
              <i class="fas fa-plus"></i> Adicionar Categoria
            </button>
          </div>

          <div class="admin-card-body">
            <div class="admin-table-responsive">
              <table class="admin-table">
                <thead>
                  <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Produtos</th>
                    <th>Destaque</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($categorias as $categoria): ?>
                    <tr>
                      <td>
                        <?php if (!empty($categoria['imagem'])): ?>
                          <img src="<?= htmlspecialchars($categoria['imagem']) ?>"
                            alt="<?= htmlspecialchars($categoria['nome']) ?>"
                            class="product-thumbnail" />
                        <?php else: ?>
                          <span class="no-image">Sem imagem</span>
                        <?php endif; ?>
                      </td>
                      <td><?= htmlspecialchars($categoria['nome']) ?></td>
                      <td><?= htmlspecialchars($categoria['quantidade_produtos']) ?></td>
                      <td>
                        <?php if ($categoria['destaque']): ?>
                          <span class="status-badge instock">Sim</span>
                        <?php else: ?>
                          <span class="status-badge outofstock">Não</span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <div class="action-buttons">
                          <button
                            class="action-btn view-btn"
                            title="Visualizar"
                            data-id="<?= $categoria['id'] ?>">
                            <i class="fas fa-eye"></i>
                          </button>
                          <button
                            class="action-btn edit-btn"
                            title="Editar"
                            data-id="<?= $categoria['id'] ?>"
                            data-nome="<?= htmlspecialchars($categoria['nome']) ?>"
                            data-imagem="<?= htmlspecialchars($categoria['imagem']) ?>"
                            data-destaque="<?= $categoria['destaque'] ?>">
                            <i class="fas fa-edit"></i>
                          </button>
                          <button
                            class="action-btn delete-btn"
                            title="Excluir"
                            data-id="<?= $categoria['id'] ?>">
                            <i class="fas fa-trash"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>

            <!-- <div class="admin-table-actions">
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
            </div> -->
          </div>
        </div>
      </div>
    </main>
  </div>

  <!-- Add/Edit Category Modal -->
  <div class="admin-modal" id="categoryModal">
    <div class="admin-modal-content">
      <div class="admin-modal-header">
        <h3 id="categoryModalTitle">Adicionar Categoria</h3>
        <button type="button" class="admin-modal-close">&times;</button>
      </div>
      <div class="admin-modal-body">
        <form id="categoryForm" class="admin-form" method="POST" action="<?= BASE_URL ?>/adminCategorias/create">
          <input type="hidden" id="categoryId" name="id" value="" />
          <div class="form-group">
            <label for="categoryName">Nome da Categoria*</label>
            <input type="text" id="categoryName" name="nome" required />
          </div>
          <div class="form-group">
            <label for="categoryImage">Imagem da Categoria*</label>
            <input type="text" id="categoryImage" name="imagem" />
          </div>
          <div class="form-group">
            <label>Destaque</label>
            <input type="checkbox" id="categoryFeatured" name="destaque" value="1" />
          </div>
          <div class="admin-modal-footer">
            <button type="button" class="admin-btn admin-btn-secondary admin-modal-cancel">
              Cancelar
            </button>
            <button type="submit" class="admin-btn admin-btn-primary">
              Salvar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Delete Confirmation Modal -->
  <!-- <div class="admin-modal" id="deleteModal">
    <div class="admin-modal-content">
      <div class="admin-modal-header">
        <h3>Confirmar Exclusão</h3>
        <button class="admin-modal-close">&times;</button>
      </div>
      <div class="admin-modal-body">
        <p>
          Tem certeza que deseja excluir esta categoria? Esta ação não pode
          ser desfeita e todos os produtos associados a esta categoria ficarão
          sem categoria.
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
  </div> -->

  <script src="../js/admin.js"></script>
  <script>
    const baseUrl = '<?= BASE_URL ?>';

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

    // Category Modal
    const categoryModal = document.getElementById("categoryModal");
    const categoryForm = document.getElementById("categoryForm");
    const categoryModalTitle =
      document.getElementById("categoryModalTitle");

    // Open Add Category Modal
    document
      .getElementById("addCategoryBtn")
      .addEventListener("click", function() {
        categoryModalTitle.textContent = "Adicionar Categoria";
        categoryForm.reset();
        document.getElementById("categoryId").value = "";
        categoryModal.classList.add("show");
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

    // Open Edit Category Modal
    const editButtons = document.querySelectorAll(".edit-btn");
    editButtons.forEach((button) => {
      button.addEventListener("click", function() {
        const id = this.dataset.id;
        const nome = this.dataset.nome;
        const imagem = this.dataset.imagem;
        const destaque = this.dataset.destaque === "1";

        categoryForm.action = "<?= BASE_URL ?>/adminCategorias/update";
        categoryModalTitle.textContent = "Editar Categoria";

        document.getElementById("categoryId").value = id;
        document.getElementById("categoryName").value = nome;
        document.getElementById("categoryImage").value = imagem;
        document.getElementById("categoryFeatured").checked = destaque;

        categoryModal.classList.add("show");
      });
    });

    // Delete Category
    const deleteButtons = document.querySelectorAll(".delete-btn");
    deleteButtons.forEach((button) => {
      button.addEventListener("click", function() {
        const id = this.dataset.id;
        const confirmDelete = confirm("Tem certeza que deseja excluir esta categoria?");
        if (confirmDelete) {
          window.location.href = `<?= BASE_URL ?>/adminCategorias/delete/${id}`;
        }
      });
    });

    // Fechar modal após submit (opcional)
    document.getElementById('categoryForm').addEventListener('submit', function() {
      document.querySelectorAll('.admin-modal').forEach(modal => {
        modal.classList.remove('show');
      });
    });


    // Ver categoria
    const viewButtons = document.querySelectorAll(".view-btn");
    viewButtons.forEach((button) => {
      button.addEventListener("click", function() {
        const categoriaId = this.getAttribute("data-id");
        window.location.href = `${baseUrl}/produtos?categoria=${encodeURIComponent(categoriaId)}&&url=produtos`;

      });
    });
  </script>
</body>

</html>