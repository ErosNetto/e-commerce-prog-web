<?php
require_once '../app/helpers/Auth.php';
Auth::iniciarSessao();
?>

<header>
  <div class="container">
    <div class="logo">
      <h1>Cantinho<span>Verde</span></h1>
    </div>
    <nav>
      <ul>
        <li><a href="<?= BASE_URL ?>/home" class="active">Início</a></li>
        <li><a href="<?= BASE_URL ?>/produtos">Produtos</a></li>
        <li><a href="<?= BASE_URL ?>/sobre">Sobre</a></li>
        <li><a href="<?= BASE_URL ?>/contato">Contato</a></li>
      </ul>
    </nav>
    <div class="icons">
      <?php if (Auth::isLoggedIn()): ?>
        <?php if (Auth::isAdmin()): ?>
          <a href="<?= BASE_URL ?>/adminDashboard" title="Painel Administrativo">
            <i class="fas fa-tachometer-alt"></i>
          </a>
        <?php endif; ?>

        <a href="<?= BASE_URL ?>/carrinho" title="Carrinho">
          <i class="fas fa-shopping-cart"></i>
        </a>

        <a href="<?= BASE_URL ?>/usuario/perfil" title="Meu Perfil">
          <i class="fas fa-user"></i>
          <!-- <span><?= htmlspecialchars(Auth::getUser()['name']) ?></span> -->
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