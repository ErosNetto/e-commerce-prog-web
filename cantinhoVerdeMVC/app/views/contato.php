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
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/contato.css" />
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
          <li><a href="<?= BASE_URL ?>/contato" class="active">Contato</a></li>
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
      <h1>Entre em Contato</h1>
      <div class="breadcrumb">
        <a href="<?= BASE_URL ?>/home">Início</a> / <span>Contato</span>
      </div>
    </div>
  </section>

  <section class="contact-section">
    <div class="container">
      <div class="contact-container">
        <div class="contact-info-card">
          <h2>Informações de Contato</h2>
          <p class="contact-description">
            Estamos sempre prontos para atender você. Entre em contato conosco
            através dos canais abaixo ou preencha o formulário.
          </p>

          <div class="info-items">
            <div class="info-item">
              <div class="info-icon">
                <i class="fas fa-map-marker-alt"></i>
              </div>
              <div class="info-content">
                <h3>Endereço</h3>
                <p>
                  Av. das Plantas, 123<br />Jardim Botânico<br />São Paulo -
                  SP, 01310-100
                </p>
              </div>
            </div>

            <div class="info-item">
              <div class="info-icon">
                <i class="fas fa-phone-alt"></i>
              </div>
              <div class="info-content">
                <h3>Telefone</h3>
                <p>(11) 99999-9999<br />(11) 3333-3333</p>
              </div>
            </div>

            <div class="info-item">
              <div class="info-icon">
                <i class="fas fa-envelope"></i>
              </div>
              <div class="info-content">
                <h3>E-mail</h3>
                <p>
                  contato@plantashop.com.br<br />suporte@plantashop.com.br
                </p>
              </div>
            </div>

            <div class="info-item">
              <div class="info-icon">
                <i class="fas fa-clock"></i>
              </div>
              <div class="info-content">
                <h3>Horário de Atendimento</h3>
                <p>
                  Segunda a Sexta: 9h às 18h<br />Sábado: 9h às 13h<br />Domingo:
                  Fechado
                </p>
              </div>
            </div>
          </div>

          <div class="social-contact">
            <h3>Siga-nos nas Redes Sociais</h3>
            <div class="social-icons">
              <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
              <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
              <a href="#" class="social-icon"><i class="fab fa-pinterest-p"></i></a>
              <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
              <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
            </div>
          </div>
        </div>

        <div class="contact-form-container">
          <h2>Envie uma Mensagem</h2>
          <p class="form-description">
            Preencha o formulário abaixo e entraremos em contato o mais breve
            possível.
          </p>

          <form class="contact-form">
            <div class="form-row">
              <div class="form-group">
                <label for="name">Nome Completo*</label>
                <input type="text" id="name" required />
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="email">E-mail*</label>
                <input type="email" id="email" required />
              </div>
              <div class="form-group">
                <label for="phone">Telefone</label>
                <input type="tel" id="phone" />
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="subject">Assunto*</label>
                <select id="subject" required>
                  <option value="">Selecione um assunto</option>
                  <option value="duvida">Dúvida sobre Produto</option>
                  <option value="pedido">Informações sobre Pedido</option>
                  <option value="reclamacao">Reclamação</option>
                  <option value="sugestao">Sugestão</option>
                  <option value="parceria">Proposta de Parceria</option>
                  <option value="outro">Outro</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="message">Mensagem*</label>
                <textarea id="message" rows="6" required></textarea>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group checkbox-group">
                <input type="checkbox" id="privacy" required />
                <label for="privacy">Concordo com a <a href="#">Política de Privacidade</a> e
                  com o uso dos meus dados para contato.</label>
              </div>
            </div>

            <div class="form-actions">
              <button type="submit" class="btn">Enviar Mensagem</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <section class="map-section">
    <div class="container">
      <h2 class="section-title">Nossa Localização</h2>
      <div class="map-container">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3657.1975874201207!2d-46.65679372376788!3d-23.56518066133692!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce59c8da0aa315%3A0xd59f9431f2c9776a!2sAv.%20Paulista%2C%20S%C3%A3o%20Paulo%20-%20SP!5e0!3m2!1spt-BR!2sbr!4v1682530000000!5m2!1spt-BR!2sbr"
          width="100%"
          height="450"
          style="border: 0"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </section>

  <section class="faq-section">
    <div class="container">
      <h2 class="section-title">Perguntas Frequentes</h2>
      <div class="faq-container">
        <div class="faq-item">
          <div class="faq-question">
            <h3>Qual o prazo de entrega?</h3>
            <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
          </div>
          <div class="faq-answer">
            <p>
              O prazo de entrega varia de acordo com a sua localização. Para a
              cidade de São Paulo, o prazo é de 1 a 3 dias úteis. Para outras
              capitais, de 3 a 5 dias úteis. Para demais localidades, o prazo
              pode ser de até 7 dias úteis. Após a confirmação do pagamento,
              você receberá um e-mail com o código de rastreamento.
            </p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">
            <h3>Como cuidar das minhas plantas?</h3>
            <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
          </div>
          <div class="faq-answer">
            <p>
              Cada planta tem necessidades específicas de cuidado. Na página
              de cada produto, você encontrará informações detalhadas sobre
              rega, iluminação e outros cuidados necessários. Além disso,
              enviamos um guia de cuidados junto com cada planta adquirida. Se
              tiver dúvidas específicas, entre em contato com nossa equipe de
              atendimento.
            </p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">
            <h3>Posso trocar ou devolver um produto?</h3>
            <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
          </div>
          <div class="faq-answer">
            <p>
              Sim, você pode solicitar a troca ou devolução em até 7 dias após
              o recebimento do produto, conforme o Código de Defesa do
              Consumidor. Para plantas, garantimos a chegada em perfeito
              estado. Caso a planta chegue danificada, entre em contato
              imediatamente com fotos do produto para que possamos
              providenciar a substituição.
            </p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">
            <h3>Quais formas de pagamento são aceitas?</h3>
            <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
          </div>
          <div class="faq-answer">
            <p>
              Aceitamos cartões de crédito (Visa, Mastercard, American
              Express, Elo), pagamento via PIX, boleto bancário e
              transferência bancária. Para cartões de crédito, oferecemos
              parcelamento em até 10x sem juros para compras acima de R$
              100,00.
            </p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">
            <h3>Vocês entregam para todo o Brasil?</h3>
            <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
          </div>
          <div class="faq-answer">
            <p>
              Sim, realizamos entregas para todo o território nacional. O
              valor do frete é calculado com base no CEP de entrega e no
              volume/peso dos produtos adquiridos. Para compras acima de R$
              150,00, oferecemos frete grátis para as principais capitais do
              país.
            </p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">
            <h3>As plantas são seguras para animais de estimação?</h3>
            <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
          </div>
          <div class="faq-answer">
            <p>
              Nem todas as plantas são seguras para animais de estimação. Na
              descrição de cada produto, informamos se a planta é tóxica ou
              não para cães e gatos. Recomendamos sempre manter as plantas
              fora do alcance dos animais, mesmo aquelas consideradas não
              tóxicas, para evitar danos à planta e possíveis problemas
              digestivos nos pets.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="newsletter-section">
    <div class="container">
      <div class="newsletter-container">
        <div class="newsletter-content">
          <h2>Assine Nossa Newsletter</h2>
          <p>
            Receba dicas de cuidados com plantas, novidades e ofertas
            exclusivas diretamente no seu e-mail.
          </p>
        </div>
        <form class="newsletter-form">
          <input type="email" placeholder="Seu melhor e-mail" required />
          <button class="btn">Assinar</button>
        </form>
      </div>
    </div>
  </section>

  <?php require_once 'partials/footer.php'; ?>

  <script>
    // Funções para a página de contato
    document.addEventListener("DOMContentLoaded", function() {
      // Accordion para as FAQs
      const faqItems = document.querySelectorAll(".faq-item");

      faqItems.forEach((item) => {
        const question = item.querySelector(".faq-question");

        question.addEventListener("click", function() {
          // Toggle active class
          item.classList.toggle("active");

          // Toggle icon
          const icon = this.querySelector(".faq-icon i");
          if (item.classList.contains("active")) {
            icon.classList.remove("fa-chevron-down");
            icon.classList.add("fa-chevron-up");
          } else {
            icon.classList.remove("fa-chevron-up");
            icon.classList.add("fa-chevron-down");
          }
        });
      });

      // Form submission
      const contactForm = document.querySelector(".contact-form");

      contactForm.addEventListener("submit", function(e) {
        e.preventDefault();

        // Simulate form submission
        const submitButton = this.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.textContent = "Enviando...";

        setTimeout(() => {
          // Show success message
          const formContainer = document.querySelector(
            ".contact-form-container"
          );
          formContainer.innerHTML = `
                        <div class="success-message">
                            <div class="success-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h2>Mensagem Enviada com Sucesso!</h2>
                            <p>Obrigado por entrar em contato conosco. Sua mensagem foi recebida e responderemos o mais breve possível.</p>
                        </div>
                    `;
        }, 1500);
      });
    });
  </script>
</body>

</html>