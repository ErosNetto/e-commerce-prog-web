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
        <a href="<?= BASE_URL ?>/home">Início</a> / <a href="<?= BASE_URL ?>/produtos">Produtos</a> / <a href="<?= BASE_URL ?>/home">Plantas de Interior</a> / <span>Zamioculca</span>
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
            <img
              src="images/products/planta1.jpg"
              alt="Zamioculca"
              id="mainImage" />
            <div class="image-zoom-icon">
              <i class="fas fa-search-plus"></i>
            </div>
          </div>
          <div class="product-thumbnails">
            <div
              class="thumbnail active"
              data-image="images/products/planta1.jpg">
              <img
                src="images/products/planta1.jpg"
                alt="Zamioculca - Imagem 1" />
            </div>
            <div class="thumbnail" data-image="images/products/planta1-2.jpg">
              <img
                src="images/products/planta1-2.jpg"
                alt="Zamioculca - Imagem 2" />
            </div>
            <div class="thumbnail" data-image="images/products/planta1-3.jpg">
              <img
                src="images/products/planta1-3.jpg"
                alt="Zamioculca - Imagem 3" />
            </div>
            <div class="thumbnail" data-image="images/products/planta1-4.jpg">
              <img
                src="images/products/planta1-4.jpg"
                alt="Zamioculca - Imagem 4" />
            </div>
          </div>
        </div>

        <!-- Product Info -->
        <div class="product-info">
          <h1 class="product-title">Zamioculca</h1>

          <!-- <div class="product-rating">
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </div>
            <span class="rating-count">(32 avaliações)</span>
          </div> -->

          <div class="product-price">
            <span class="current-price">R$89,90</span>
            <span class="installment">ou 3x de R$29,97 sem juros</span>
          </div>
          <div class="product-short-description">
            <p>
              A Zamioculca é uma planta de interior conhecida por sua
              resistência e baixa manutenção. Ideal para ambientes internos
              com pouca luz.
            </p>
          </div>
          <div class="product-meta">
            <div class="meta-item">
              <span class="meta-label">Categoria:</span>
              <span class="meta-value">Planta de Interior</span>
            </div>
            <div class="meta-item">
              <span class="meta-label">Tamanho:</span>
              <span class="meta-value">Médio (40-60cm)</span>
            </div>
            <div class="meta-item">
              <span class="meta-label">Nível de Cuidado:</span>
              <span class="meta-value">Fácil</span>
            </div>
            <div class="meta-item">
              <span class="meta-label">Disponibilidade:</span>
              <span class="meta-value in-stock">Em estoque</span>
            </div>
          </div>
          <div class="product-options">
            <div class="option-group">
              <label>Tamanho do Vaso:</label>
              <div class="option-buttons">
                <button class="option-button">P (13cm)</button>
                <button class="option-button active">M (15cm)</button>
                <button class="option-button">G (21cm)</button>
              </div>
            </div>
          </div>
          <div class="product-actions">
            <div class="quantity-selector">
              <button class="quantity-btn minus">-</button>
              <input type="number" value="1" min="1" class="quantity-input" />
              <button class="quantity-btn plus">+</button>
            </div>
            <button class="btn-add-to-cart">Adicionar ao Carrinho</button>
            <button class="btn-buy-now">Comprar Agora</button>
          </div>
        </div>
      </div>

      <!-- Product Tabs -->
      <div class="product-tabs">
        <div class="tabs-header"></div>
        <div class="tabs-content">
          <div class="tab-panel active" id="description">
            <div class="tab-content">
              <h3>Sobre a Zamioculca</h3>
              <p>
                A Zamioculca (Zamioculcas zamiifolia), também conhecida como
                planta ZZ, é uma planta tropical originária da África
                Oriental. Ela se tornou extremamente popular como planta de
                interior devido à sua aparência elegante e à facilidade de
                cultivo.
              </p>
              <p>
                Com folhas brilhantes, verde-escuras e uma estrutura ereta, a
                Zamioculca adiciona um toque de sofisticação a qualquer
                ambiente. Suas folhas são compostas por folíolos ovais que
                crescem em hastes carnudas, criando um visual arquitetônico
                distinto.
              </p>
              <p>
                Uma das características mais apreciadas da Zamioculca é sua
                incrível resistência. Ela pode sobreviver em condições de
                pouca luz, baixa umidade e até mesmo com regas esporádicas, o
                que a torna ideal para iniciantes ou para pessoas com pouco
                tempo para cuidar de plantas.
              </p>
              <p>
                Além de sua beleza e facilidade de cultivo, a Zamioculca
                também é conhecida por suas propriedades purificadoras de ar,
                ajudando a melhorar a qualidade do ambiente interno.
              </p>

              <div class="product-features">
                <div class="feature">
                  <div class="feature-icon">
                    <i class="fas fa-sun"></i>
                  </div>
                  <div class="feature-text">
                    <h4>Luz</h4>
                    <p>
                      Tolera baixa luminosidade, mas cresce melhor em luz
                      indireta.
                    </p>
                  </div>
                </div>
                <div class="feature">
                  <div class="feature-icon">
                    <i class="fas fa-tint"></i>
                  </div>
                  <div class="feature-text">
                    <h4>Água</h4>
                    <p>
                      Rega moderada, deixando o solo secar entre as regas.
                    </p>
                  </div>
                </div>
                <div class="feature">
                  <div class="feature-icon">
                    <i class="fas fa-thermometer-half"></i>
                  </div>
                  <div class="feature-text">
                    <h4>Temperatura</h4>
                    <p>Prefere temperaturas entre 18°C e 26°C.</p>
                  </div>
                </div>
                <div class="feature">
                  <div class="feature-icon">
                    <i class="fas fa-paw"></i>
                  </div>
                  <div class="feature-text">
                    <h4>Pet Friendly</h4>
                    <p>Não. Tóxica para cães e gatos.</p>
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
</body>

</html>