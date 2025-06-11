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
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/sobre.css" />
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
          <li><a href="<?= BASE_URL ?>/sobre" class="active">Sobre</a></li>
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

  <!-- Page Header -->
  <section class="page-header">
    <div class="container">
      <h1>Sobre Nós</h1>
      <div class="breadcrumb">
        <a href="<?= BASE_URL ?>/home">Início</a> / <span>Sobre Nós</span>
      </div>
    </div>
  </section>

  <!-- About Intro Section -->
  <section class="about-intro">
    <div class="container">
      <div class="about-intro-container">
        <div class="about-intro-content">
          <h2>Conheça a Plantas Marketplace</h2>
          <p class="subtitle">Transformando espaços com verde desde 2015</p>
          <p>
            Somos uma empresa apaixonada por plantas e pela natureza, dedicada
            a trazer mais verde para a vida das pessoas. Nossa jornada começou
            com uma pequena loja física e hoje somos um dos maiores
            marketplaces de plantas do Brasil.
          </p>
          <p>
            Na Plantas Marketplace, acreditamos que cada planta tem o poder de
            transformar um ambiente e melhorar a qualidade de vida. Por isso,
            trabalhamos com dedicação para oferecer as melhores espécies,
            cuidadosamente selecionadas e cultivadas com amor.
          </p>

          <div class="about-stats">
            <div class="stat-item">
              <div class="stat-number">8+</div>
              <div class="stat-text">Anos de Experiência</div>
            </div>
            <div class="stat-item">
              <div class="stat-number">5000+</div>
              <div class="stat-text">Clientes Satisfeitos</div>
            </div>
            <div class="stat-item">
              <div class="stat-number">300+</div>
              <div class="stat-text">Variedades de Plantas</div>
            </div>
            <div class="stat-item">
              <div class="stat-number">98%</div>
              <div class="stat-text">Taxa de Satisfação</div>
            </div>
          </div>
        </div>
        <div class="about-intro-image">
          <img
            src="https://th.bing.com/th/id/OIP.YE0E8C-t1FgTeE5vBpaq0wHaEJ?w=324&h=182&c=7&r=0&o=7&pid=1.7&rm=3"
            alt="Equipe Plantas Marketplace" />
        </div>
      </div>
    </div>
  </section>

  <!-- Our Story Section -->
  <section class="our-story">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Nossa História</h2>
        <p class="section-subtitle">
          Uma jornada de paixão, crescimento e amor pelas plantas
        </p>
      </div>

      <div class="timeline">
        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <div class="timeline-content">
            <h3>O Início</h3>
            <p>
              Tudo começou com uma pequena loja física no bairro Jardim
              Botânico, fundada pelos amigos Maria e João, ambos apaixonados
              por plantas e jardinagem.
            </p>
          </div>
        </div>

        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <div class="timeline-content">
            <h3>Expansão</h3>
            <p>
              Com o crescimento da demanda, expandimos nossa loja física e
              começamos a oferecer serviços de paisagismo e consultoria em
              jardinagem.
            </p>
          </div>
        </div>

        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <div class="timeline-content">
            <h3>Entrada no Digital</h3>
            <p>
              Lançamos nossa primeira loja online, permitindo que clientes de
              todo o Brasil tivessem acesso às nossas plantas e produtos.
            </p>
          </div>
        </div>

        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <div class="timeline-content">
            <h3>Crescimento Durante a Pandemia</h3>
            <p>
              Durante a pandemia, vimos um aumento significativo na demanda
              por plantas para decoração de interiores, o que nos levou a
              expandir nossa equipe e operações.
            </p>
          </div>
        </div>

        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <div class="timeline-content">
            <h3>Marketplace</h3>
            <p>
              Transformamos nosso e-commerce em um marketplace, permitindo que
              produtores e vendedores de plantas de todo o país pudessem
              oferecer seus produtos em nossa plataforma.
            </p>
          </div>
        </div>

        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <div class="timeline-content">
            <h3>Presente e Futuro</h3>
            <p>
              Hoje, somos um dos maiores marketplaces de plantas do Brasil,
              com mais de 300 variedades de plantas e milhares de clientes
              satisfeitos. Continuamos crescendo e inovando, sempre com o
              objetivo de aproximar as pessoas da natureza.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Our Mission Section -->
  <section class="our-mission">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Missão, Visão e Valores</h2>
        <p class="section-subtitle">
          Os princípios que guiam nossa empresa e nosso trabalho
        </p>
      </div>

      <div class="mission-container">
        <div class="mission-item">
          <div class="mission-icon">
            <i class="fas fa-seedling"></i>
          </div>
          <h3>Missão</h3>
          <p>
            Aproximar as pessoas da natureza, oferecendo plantas de qualidade
            e conhecimento sobre seu cultivo, contribuindo para ambientes mais
            saudáveis e harmoniosos.
          </p>
        </div>

        <div class="mission-item">
          <div class="mission-icon">
            <i class="fas fa-eye"></i>
          </div>
          <h3>Visão</h3>
          <p>
            Ser reconhecida como a principal referência em plantas e
            jardinagem no Brasil, inspirando as pessoas a cultivarem seu
            próprio verde e a valorizarem a natureza.
          </p>
        </div>

        <div class="mission-item">
          <div class="mission-icon">
            <i class="fas fa-heart"></i>
          </div>
          <h3>Valores</h3>
          <p>
            Sustentabilidade, qualidade, conhecimento, paixão pela natureza,
            atendimento personalizado e compromisso com a satisfação do
            cliente.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Our Team Section -->
  <section class="our-team">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Nossa Equipe</h2>
        <p class="section-subtitle">
          Conheça as pessoas apaixonadas que fazem a Plantas Marketplace
          acontecer
        </p>
      </div>

      <div class="team-container">
        <div class="team-member">
          <div class="member-info">
            <h3>Eros Netto</h3>
            <div class="member-role">Líder de Desenvolvimento</div>
            <p class="member-bio">
              Colaborou no desenvolvimento do frontend, focando na experiência do usuário e no design visual da plataforma.
            </p>
          </div>
        </div>

        <div class="team-member">
          <div class="member-info">
            <h3>Gabriel Schultz</h3>
            <div class="member-role">Desenvolvedor Frontend</div>
            <p class="member-bio">
              Contribuiu para o desenvolvimento do backend, implementando funcionalidades do servidor e garantindo a integração com o banco de dados.
            </p>
          </div>
        </div>

        <div class="team-member">
          <div class="member-info">
            <h3>Ronald Lucas</h3>
            <div class="member-role">Desenvolvedor Frontend</div>
            <p class="member-bio">
              Trabalhou no desenvolvimento do frontend, criando interfaces de usuário responsivas e atraentes para a plataforma.
            </p>
          </div>
        </div>

        <div class="team-member">
          <div class="member-info">
            <h3>Luigi Gustavo</h3>
            <div class="member-role">Desenvolvedor Backend</div>
            <p class="member-bio">
              Responsável pela arquitetura do software, projetando a estrutura técnica e garantindo a escalabilidade e eficiência do sistema.
            </p>
          </div>
        </div>

        <div class="team-member">
          <div class="member-info">
            <h3>Vitor Hugo Deschamps</h3>
            <div class="member-role">Desenvolvedor de Banco de Dados</div>
            <p class="member-bio">
              Projetou e implementou o banco de dados, garantindo a organização e eficiência no armazenamento e recuperação de dados da plataforma.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Partners Section -->
  <section class="partners">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Nossos Parceiros</h2>
        <p class="section-subtitle">
          Empresas e instituições que confiam em nosso trabalho
        </p>
      </div>

      <div class="partners-grid">
        <div class="partner-item">
          <img src="https://www.logo.wine/a/logo/Bayer/Bayer-Logo.wine.svg" alt="Bayer" />
        </div>
        <div class="partner-item">
          <img src="https://www.logo.wine/a/logo/Syngenta/Syngenta-Logo.wine.svg" alt="Syngenta" />
        </div>
        <div class="partner-item">
          <img src="https://www.logo.wine/a/logo/Walmart/Walmart-Logo.wine.svg" alt="Walmart" />
        </div>
        <div class="partner-item">
          <img src="https://www.logo.wine/a/logo/Lowe%27s/Lowe%27s-Logo.wine.svg" alt="Lowe's" />
        </div>
        <div class="partner-item">
          <img src="https://www.logo.wine/a/logo/Syngenta/Syngenta-Logo.wine.svg" alt="Syngenta" />
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

  <?php require_once 'partials/footer.php'; ?>
</body>

</html>