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
          <li><a href="<?= BASE_URL ?>/categorias"">Categorias</a></li>
          <li><a href=" <?= BASE_URL ?>/sobre">Sobre</a></li>
          <li><a href="<?= BASE_URL ?>/contato">Contato</a></li>
        </ul>
      </nav>
      <div class="icons">
        <a href="<?= BASE_URL ?>/carrinho"><i class="fas fa-shopping-cart"></i></a>
        <a href="<?= BASE_URL ?>/conta"><i class="fas fa-user"></i></a>
        <a href="<?= BASE_URL ?>/pesquisa"><i class="fas fa-search"></i></a>
      </div>
    </div>
  </header>

  <section class="page-header">
    <div class="container">
      <h1>Detalhes do Produto</h1>
      <div class="breadcrumb">
        <a href="<?= BASE_URL ?>/home">Início</a> /
        <a href="<?= BASE_URL ?>/produtos">Produtos</a> /
        <?php if (!empty($produto['categorias'])): ?>
          <a href="<?= BASE_URL ?>/categorias/<?= $produto['categorias'][0] ?>"><?= $produto['categorias'][0] ?></a> /
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

          <div class="product-thumbnails">
            <!-- Miniatura da imagem principal -->
            <div class="thumbnail active" data-image="<?= $produto['imagem_principal'] ?>">
              <img src="<?= $produto['imagem_principal'] ?>" alt="<?= $produto['nome'] ?> - Imagem principal" />
            </div>

            <!-- Miniaturas adicionais -->
            <?php if (!empty($produto['imagens_adicionais'])): ?>
              <?php foreach ($produto['imagens_adicionais'] as $imagem): ?>
                <?php if ($imagem !== $produto['imagem_principal']): ?>
                  <div class="thumbnail" data-image="<?= BASE_URL ?>/<?= $imagem ?>">
                    <img src="<?= $imagem ?>" alt="<?= $produto['nome'] ?>" />
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>
            <?php endif; ?>
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
            <div class="product-actions">
              <div class="quantity-selector">
                <button class="quantity-btn minus">-</button>
                <input type="number" value="1" min="1" max="<?= $produto['estoque'] ?>" class="quantity-input" />
                <button class="quantity-btn plus">+</button>
              </div>
              <button class="btn-add-to-cart">Adicionar ao Carrinho</button>
              <button class="btn-buy-now">Comprar Agora</button>
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
    document.addEventListener('DOMContentLoaded', function() {
      // Seleciona os elementos
      const mainImage = document.getElementById('mainImage');
      const thumbnails = document.querySelectorAll('.thumbnail');

      // Adiciona evento de clique para cada miniatura
      thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
          // Obtém a imagem da miniatura clicada
          const thumbnailImg = this.querySelector('img');
          const newSrc = thumbnailImg.src;

          // Atualiza a imagem principal
          mainImage.src = newSrc;

          // Remove a classe 'active' de todas as miniaturas
          thumbnails.forEach(t => t.classList.remove('active'));

          // Adiciona a classe 'active' na miniatura clicada
          this.classList.add('active');
        });
      });
    });
  </script>
</body>

</html>