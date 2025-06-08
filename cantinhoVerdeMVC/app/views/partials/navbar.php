<?php
// Incluir a classe Auth
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
        <li><a href="<?= BASE_URL ?>/categorias">Categorias</a></li>
        <li><a href="<?= BASE_URL ?>/sobre">Sobre</a></li>
        <li><a href="<?= BASE_URL ?>/contato">Contato</a></li>
      </ul>
    </nav>
    <div class="icons">
      <a href="<?= BASE_URL ?>/carrinho"><i class="fas fa-shopping-cart"></i></a>
      
      <?php if (Auth::isLoggedIn()): ?>
        <div class="user-menu">
          <a href="<?= BASE_URL ?>/usuario/perfil" class="user-link">
            <i class="fas fa-user"></i>
            <span><?= htmlspecialchars(Auth::getUser()['name']) ?></span>
          </a>
          <div class="dropdown-menu">
            <a href="<?= BASE_URL ?>/usuario/perfil">Meu Perfil</a>
            <?php if (Auth::isAdmin()): ?>
              <a href="<?= BASE_URL ?>/admin">Painel Admin</a>
            <?php endif; ?>
            <a href="<?= BASE_URL ?>/usuario/logout">Sair</a>
          </div>
        </div>
      <?php else: ?>
        <a href="<?= BASE_URL ?>/usuario/login"><i class="fas fa-user"></i></a>
      <?php endif; ?>
      
      <!-- <a href="<?= BASE_URL ?>/pesquisa"><i class="fas fa-search"></i></a> -->
    </div>
  </div>
</header>