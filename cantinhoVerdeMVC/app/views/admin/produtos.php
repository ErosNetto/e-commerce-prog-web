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
            <a href="<?= BASE_URL ?>">Home</a> / <span>Produtos</span>
          </nav>
        </div>

        <div class="admin-header-right">
          <h3><?= htmlspecialchars($usuario["name"]) ?></h3>
        </div>
      </header>

      <!-- Products Content -->
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
            <h2>Lista de Produtos</h2>
            <button class="admin-btn admin-btn-primary" id="addProdutoBtn">
              <i class="fas fa-plus"></i> Adicionar Produto
            </button>
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
                    <th>ID</th>
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
                  <?php foreach ($produtos as $produto): ?>
                    <tr>
                      <td><?= htmlspecialchars($produto['id']) ?></td>
                      <td>
                        <?php if (!empty($produto['imagem_principal'])): ?>
                          <img src="<?= htmlspecialchars($produto['imagem_principal']) ?>"
                            alt="<?= htmlspecialchars($produto['nome']) ?>"
                            class="product-thumbnail" />
                        <?php else: ?>
                          <span class="no-image">Sem imagem</span>
                        <?php endif; ?>
                      </td>
                      <td><?= htmlspecialchars($produto['nome']) ?></td>
                      <td>
                        <?php if (!empty($produto['categorias_nomes'][0])): ?>
                          <?= htmlspecialchars($produto['categorias_nomes'][0]) ?>
                        <?php else: ?>
                          Sem categoria
                        <?php endif; ?>
                      </td>
                      <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                      <td><?= htmlspecialchars($produto['estoque']) ?></td>
                      <td>
                        <?php if ($produto['estoque'] > 0): ?>
                          <span class="status-badge instock">Em Estoque</span>
                        <?php else: ?>
                          <span class="status-badge outofstock">Fora de Estoque</span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <div class="action-buttons">
                          <button
                            class="action-btn view-btn"
                            title="Visualizar"
                            data-id="<?= $produto['id'] ?>">
                            <i class="fas fa-eye"></i>
                          </button>
                          <button
                            class="action-btn edit-btn"
                            title="Editar"
                            data-id="<?= $produto['id'] ?>"
                            data-nome="<?= htmlspecialchars($produto['nome']) ?>"
                            data-descricao="<?= htmlspecialchars($produto['descricao']) ?>"
                            data-descricaocurta="<?= htmlspecialchars($produto['descricao_curta']) ?>"
                            data-imagem="<?= htmlspecialchars($produto['imagem_principal']) ?>"
                            data-preco="<?= htmlspecialchars($produto['preco']) ?>"
                            data-estoque="<?= htmlspecialchars($produto['estoque']) ?>"
                            data-nivelcuidado="<?= htmlspecialchars($produto['nivel_cuidado']) ?>"
                            data-tamanho="<?= htmlspecialchars($produto['tamanho']) ?>"
                            data-ambiente="<?= htmlspecialchars($produto['ambiente']) ?>"
                            data-luz="<?= htmlspecialchars($produto['luz']) ?>"
                            data-agua="<?= htmlspecialchars($produto['agua']) ?>"
                            data-destaque="<?= $produto['destaque'] ?>"
                            data-categoria="<?= !empty($produto['categorias_ids'][0]) ? $produto['categorias_ids'][0] : '' ?>">
                            <i class="fas fa-edit"></i>
                          </button>
                          <button
                            class="action-btn delete-btn"
                            title="Excluir"
                            data-id="<?= $produto['id'] ?>">
                            <i class="fas fa-trash"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
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

  <!-- Add/Edit Category Modal -->
  <div class="admin-modal" id="produtoModal">
    <div class="admin-modal-content">
      <div class="admin-modal-header">
        <h3 id="produtoModalTitle">Adicionar Produto</h3>
        <button type="button" class="admin-modal-close">&times;</button>
      </div>
      <div class="admin-modal-body">
        <form id="produtoForm" class="admin-form" method="POST" action="<?= BASE_URL ?>/adminProdutos/create">
          <input type="hidden" id="produtoId" name="id" value="" />

          <div class="form-columns">
            <div class="column">
              <div class="form-group">
                <label for="produtoName">Nome da Produto*</label>
                <input type="text" id="produtoName" name="nome" required />
              </div>

              <div class="form-group">
                <label for="produtoDescricao">Descrição</label>
                <input type="text" id="produtoDescricao" name="descricao" />
              </div>

              <div class="form-group">
                <label for="produtoDescricaoCurta">Descrição Curta</label>
                <input type="text" id="produtoDescricaoCurta" name="descricaoCurta" />
              </div>

              <div class="form-group">
                <label for="produtoImage">Imagem do Produto*</label>
                <input type="text" id="produtoImage" name="imagem" required />
              </div>

              <div class="form-group">
                <label for="produtoPreco">Preço*</label>
                <input
                  type="text"
                  id="produtoPreco"
                  name="preco"
                  inputmode="decimal"
                  pattern="[0-9]+([\.][0-9]+)?"
                  required />
              </div>

              <div class="form-group">
                <label for="produtoEstoque">Estoque*</label>
                <input type="number" id="produtoEstoque" name="estoque" required />
              </div>
            </div>

            <div class="column">
              <div class="form-group">
                <label for="produtoNivelCuidado">Nível de Cuidado</label>
                <select id="produtoNivelCuidado" name="nivel_cuidado">
                  <option value="facil">Fácil</option>
                  <option value="medio">Médio</option>
                  <option value="avancado">Avançado</option>
                </select>
              </div>

              <div class="form-group">
                <label for="produtoTamanho">Tamanho</label>
                <select id="produtoTamanho" name="tamanho">
                  <option value="pequeno">Pequeno</option>
                  <option value="medio">Médio</option>
                  <option value="grande">Grande</option>
                </select>
              </div>

              <div class="form-group">
                <label for="produtoAmbiente">Ambiente</label>
                <select id="produtoAmbiente" name="ambiente">
                  <option value="interior">Interior</option>
                  <option value="exterior">Exterior</option>
                  <option value="ambos">Ambos</option>
                </select>
              </div>

              <div class="form-group">
                <label for="produtoLuz">Luz</label>
                <select id="produtoLuz" name="luz">
                  <option value="baixa">Baixa</option>
                  <option value="media">Média</option>
                  <option value="alta">Alta</option>
                </select>
              </div>

              <div class="form-group">
                <label for="produtoAgua">Água</label>
                <select id="produtoAgua" name="agua">
                  <option value="pouca">Pouca</option>
                  <option value="media">Média</option>
                  <option value="muita">Muita</option>
                </select>
              </div>

              <div class="form-group">
                <label>Destaque</label>
                <input type="checkbox" id="produtoFeatured" name="destaque" value="1" />
              </div>
            </div>

            <div class="form-group">
              <label for="categoriaProduto">Categoria do Produto</label>
              <select id="categoriaProduto" name="categoria">
                <option value="">Sem categoria</option>
                <?php foreach ($categorias as $categoria): ?>
                  <option value="<?= htmlspecialchars($categoria['id']) ?>"><?= htmlspecialchars($categoria['nome']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
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
    const categoryModal = document.getElementById("produtoModal");
    const categoryForm = document.getElementById("produtoForm");
    const categoryModalTitle =
      document.getElementById("produtoModalTitle");

    // Open Add Category Modal
    document
      .getElementById("addProdutoBtn")
      .addEventListener("click", function() {
        categoryModalTitle.textContent = "Adicionar Produto";
        categoryForm.reset();
        document.getElementById("produtoId").value = "";
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

    // Open Edit Produto Modal
    const editButtons = document.querySelectorAll(".edit-btn");
    editButtons.forEach((button) => {
      button.addEventListener("click", function() {
        const id = this.dataset.id;
        const nome = this.dataset.nome;
        const descricao = this.dataset.descricao;
        const descricaoCurta = this.dataset.descricaocurta;
        const imagem = this.dataset.imagem;
        const preco = this.dataset.preco;
        const estoque = this.dataset.estoque;
        const nivelCuidado = this.dataset.nivelcuidado;
        const tamanho = this.dataset.tamanho;
        const ambiente = this.dataset.ambiente;
        const luz = this.dataset.luz;
        const agua = this.dataset.agua;
        const destaque = this.dataset.destaque === "1";
        const categoriaId = this.dataset.categoria;

        categoryForm.action = "<?= BASE_URL ?>/adminProdutos/update";
        categoryModalTitle.textContent = "Editar Produto";

        document.getElementById("produtoId").value = id;
        document.getElementById("produtoName").value = nome;
        document.getElementById("produtoDescricao").value = descricao;
        document.getElementById("produtoDescricaoCurta").value = descricaoCurta;
        document.getElementById("produtoImage").value = imagem;
        document.getElementById("produtoPreco").value = preco;
        document.getElementById("produtoEstoque").value = estoque;
        document.getElementById("produtoNivelCuidado").value = nivelCuidado;
        document.getElementById("produtoTamanho").value = tamanho;
        document.getElementById("produtoAmbiente").value = ambiente;
        document.getElementById("produtoLuz").value = luz;
        document.getElementById("produtoAgua").value = agua;
        document.getElementById("produtoFeatured").checked = destaque;

        // Ao abrir o modal para edição
        // document.getElementById("produtoPreco").value = parseFloat(preco).toFixed(2);

        if (categoriaId) {
          document.getElementById("categoriaProduto").value = categoriaId;
        } else {
          document.getElementById("categoriaProduto").selectedIndex = 0;
        }

        categoryModal.classList.add("show");
      });
    });

    // Delete Produto
    const deleteButtons = document.querySelectorAll(".delete-btn");
    deleteButtons.forEach((button) => {
      button.addEventListener("click", function() {
        const id = this.dataset.id;
        const confirmDelete = confirm("Tem certeza que deseja excluir esse produto?");
        if (confirmDelete) {
          window.location.href = `<?= BASE_URL ?>/adminProdutos/delete/${id}`;
        }
      });
    });

    // Fechar modal após submit (opcional)
    document.getElementById('produtoForm').addEventListener('submit', function() {
      document.querySelectorAll('.admin-modal').forEach(modal => {
        modal.classList.remove('show');
      });
    });

    // Ver produto
    const viewButtons = document.querySelectorAll(".view-btn");
    viewButtons.forEach((button) => {
      button.addEventListener("click", function() {
        const produtoId = this.getAttribute("data-id");
        window.location.href = `${baseUrl}/detalheProduto?idProduto=${encodeURIComponent(produtoId)}`;
      });
    });
  </script>
</body>

</html>