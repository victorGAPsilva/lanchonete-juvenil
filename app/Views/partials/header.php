<?php
use App\Core\Cart;

$currentPath = rtrim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/', '/') ?: '/';
?>
<header class="site-header">
  <div class="container">
    <div class="site-header__inner">
      <a class="brand" href="<?= url('/') ?>">
        <div class="brand__mark">J</div>
        <div class="brand__text">
          <span class="brand__title">Mercadinho Juvenil</span>
          <span class="brand__subtitle">Pedidos online premium</span>
        </div>
      </a>

      <nav class="nav-pills" aria-label="Categorias">
        <a class="nav-pill <?= $currentPath === '/' ? 'is-active' : '' ?>" href="<?= url('/') ?>">Início</a>
        <a class="nav-pill <?= $currentPath === '/cardapio' ? 'is-active' : '' ?>" href="<?= url('cardapio') ?>">Cardápio</a>
        <a class="nav-pill" href="<?= url('acompanhar-pedido') ?>">Acompanhar</a>
        <a class="nav-pill" href="<?= url('login') ?>">Conta</a>
      </nav>

      <a class="cart-badge" href="<?= url('carrinho') ?>">
        <span>Carrinho</span>
        <span class="cart-badge__count" data-cart-count><?= Cart::count() ?></span>
      </a>
    </div>
  </div>
</header>
