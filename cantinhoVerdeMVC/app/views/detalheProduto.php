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
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/detalhe-produto.css" />
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

          <a href="<?= BASE_URL ?>/usuario/perfil" title="Meu Perfil">
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

  <section class="page-header">
    <div class="container">
      <h1>Detalhes do Produto</h1>
      <div class="breadcrumb">
        <a href="<?= BASE_URL ?>/home">Início</a> /
        <a href="<?= BASE_URL ?>/produtos">Produtos</a> /
        <?php if (!empty($produto['categorias']) && !empty($produto['categoria_ids'])): ?>
          <a href="<?= BASE_URL ?>/produtos?categoria=<?= $produto['categoria_ids'][0] ?>&url=produtos">
            <?= $produto['categorias'][0] ?>
          </a> /
        <?php endif; ?>
        <span><?= $produto['nome'] ?></span>
      </div>
    </div>
  </section>

  <!-- Product Detail Section -->
  <section class="product-detail">
    <div class="container">
      <div class="product-detail-container">
        <!-- Product Images -->
        <div class="product-images">
          <div class="product-main-image">
            <img src="<?= $produto['imagem_principal'] ?>" alt="<?= $produto['nome'] ?>" id="mainImage" />
          </div>
        </div>

        <!-- Product Info -->
        <div class="product-info">
          <h1 class="product-title"><?= $produto['nome'] ?></h1>

          <div class="product-price">
            <span class="current-price">R$<?= $produto['preco_formatado'] ?></span>&nbsp;
            <span class="installment"><?= $produto['parcelamento'] ?></span>
          </div>

          <div class="product-short-description">
            <p><?= $produto['descricao_curta'] ?></p>
          </div>

          <div class="product-meta">
            <?php if (!empty($produto['categorias'])): ?>
              <div class="meta-item">
                <span class="meta-label">Categoria:</span>
                <span class="meta-value"><?= implode(', ', $produto['categorias']) ?></span>
              </div>
            <?php endif; ?>

            <?php if (!empty($produto['tamanho'])): ?>
              <div class="meta-item">
                <span class="meta-label">Tamanho:</span>
                <span class="meta-value"><?= ucfirst($produto['tamanho']) ?></span>
              </div>
            <?php endif; ?>

            <?php if (!empty($produto['nivel_cuidado'])): ?>
              <div class="meta-item">
                <span class="meta-label">Nível de Cuidado:</span>
                <span class="meta-value"><?= ucfirst($produto['nivel_cuidado']) ?></span>
              </div>
            <?php endif; ?>

            <div class="meta-item">
              <span class="meta-label">Disponibilidade:</span>
              <span class="meta-value <?= $produto['estoque'] > 0 ? 'in-stock' : 'out-of-stock' ?>">
                <?= $produto['estoque'] > 0 ? 'Em estoque' : 'Esgotado' ?>
              </span>
            </div>
          </div>

          <?php if ($produto['estoque'] > 0): ?>
            <form method="POST" action="<?= BASE_URL ?>/carrinho/adicionar" class="product-actions">
              <input type="hidden" name="produto_id" value="<?= $produto['id'] ?>">
              <div class="quantity-selector">
                <button type="button" class="quantity-btn minus">-</button>
                <input type="number" name="quantidade" value="1" min="1" max="<?= $produto['estoque'] ?>" class="quantity-input" />
                <button type="button" class="quantity-btn plus">+</button>
              </div>
              <button type="submit" class="btn-add-to-cart">
                <i class="fas fa-shopping-cart"></i>
                Adicionar ao Carrinho
              </button>
            </form>
          <?php else: ?>
            <div class="product-actions">
              <button class="btn-add-to-cart disabled" disabled>
                <i class="fas fa-times"></i>
                Produto Esgotado
              </button>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Product Tabs -->
      <div class="product-tabs">
        <div class="tabs-header"></div>
        <div class="tabs-content">
          <div class="tab-panel active" id="description">
            <div class="tab-content">
              <h3>Informações sobre <?= $produto['nome'] ?></h3>
              <p><?= nl2br($produto['descricao']) ?></p>

              <div class="product-features">
                <div class="feature">
                  <div class="feature-icon">
                    <i class="fas fa-sun"></i>
                  </div>
                  <div class="feature-text">
                    <h4>Luz</h4>
                    <p><?= $produto['luz'] ?></p>
                  </div>
                </div>
                <div class="feature">
                  <div class="feature-icon">
                    <i class="fas fa-tint"></i>
                  </div>
                  <div class="feature-text">
                    <h4>Água</h4>
                    <p><?= $produto['agua'] ?></p>
                  </div>
                </div>
                <div class="feature">
                  <div class="feature-icon">
                    <i class="fas fa-seedling"></i>
                  </div>
                  <div class="feature-text">
                    <h4>Ambiente</h4>
                    <p><?= $produto['ambiente'] ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Newsletter Section -->
  <section class="newsletter-section">
    <div class="container">
      <div class="newsletter-container">
        <div class="newsletter-content">
          <h2>Inscreva-se em nossa Newsletter</h2>
          <p>
            Receba dicas de cuidados com plantas e ofertas exclusivas
            diretamente no seu e-mail.
          </p>
        </div>
        <form class="newsletter-form">
          <input type="email" placeholder="Seu endereço de e-mail" required />
          <button class="btn">Inscrever-se</button>
        </form>
      </div>
    </div>
  </section>

  <!-- Image Zoom Modal -->
  <div class="image-zoom-modal" id="imageZoomModal">
    <span class="close-zoom">&times;</span>
    <img class="zoom-content" id="zoomedImage" />
  </div>

  <?php require_once 'partials/footer.php'; ?>

  <script>
    document.querySelector('.quantity-btn.minus').addEventListener('click', function() {
      const input = document.querySelector('.quantity-input');
      const currentValue = parseInt(input.value);
      if (currentValue > 1) {
        input.value = currentValue - 1;
      }
    });

    document.querySelector('.quantity-btn.plus').addEventListener('click', function() {
      const input = document.querySelector('.quantity-input');
      const currentValue = parseInt(input.value);
      const maxValue = parseInt(input.max);
      if (currentValue < maxValue) {
        input.value = currentValue + 1;
      }
    });

    const mainImage = document.getElementById('mainImage');
    const modal = document.getElementById('imageZoomModal');
    const zoomedImage = document.getElementById('zoomedImage');
    const closeZoom = document.querySelector('.close-zoom');

    mainImage.addEventListener('click', function() {
      modal.style.display = 'block';
      zoomedImage.src = this.src;
    });

    closeZoom.addEventListener('click', function() {
      modal.style.display = 'none';
    });

    modal.addEventListener('click', function(e) {
      if (e.target === modal) {
        modal.style.display = 'none';
      }
    });
  </script>
</body>

</html>