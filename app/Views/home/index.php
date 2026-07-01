<?php
use App\Models\Category;
use App\Models\Product;

$categories = Category::all();
$featured = Product::featured();
?>
<section class="hero">
  <div class="container">
    <div class="hero__panel">
      <div class="hero__grid">
        <div>
          <div class="hero__badge">🔥 Pedido rápido, sem complicação</div>
          <h1>Mercadinho Juvenil</h1>
          <p>Um site de pedidos com visual premium inspirado na logo da marca, cardápio digital, carrinho dinâmico e checkout feito para celular.</p>
          <div class="hero__actions">
            <a class="btn btn--light" href="<?= url('cardapio') ?>">Pedir agora</a>
            <a class="btn btn--ghost" href="<?= url('acompanhar-pedido') ?>">Acompanhar pedido</a>
          </div>
        </div>
        <div class="hero__logo-lockup">
          <div class="logo-emblem" aria-hidden="true">
            <div class="logo-emblem__icon-row">
              <div class="mini-icon"></div>
              <div class="mini-icon mini-icon--burger"></div>
              <div class="mini-icon"></div>
            </div>
            <div class="logo-emblem__ribbon"><strong>JUVENIL</strong></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head">
      <div>
        <h2 class="section-title">Categorias</h2>
        <p class="section-subtitle">Lanches, bebidas, porções e sobremesas em uma navegação pensada para compra rápida.</p>
      </div>
    </div>
    <div class="grid grid--cards">
      <?php foreach ($categories as $category): ?>
        <a class="card" href="<?= url('cardapio?categoria=' . urlencode($category['slug'])) ?>">
          <div class="product-thumb"><span class="product-thumb__emoji"><?= match ($category['slug']) { 'lanches' => '🍔', 'bebidas' => '🥤', 'porcoes' => '🍟', default => '🍨' } ?></span></div>
          <div class="card-body">
            <h3 class="card-title"><?= e($category['name']) ?></h3>
            <p class="section-subtitle">Ver produtos desta categoria.</p>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head">
      <div>
        <h2 class="section-title">Mais pedidos</h2>
        <p class="section-subtitle">Os itens de destaque já aparecem prontos para adicionar ao carrinho.</p>
      </div>
      <a class="btn btn--primary" href="<?= url('cardapio') ?>">Abrir cardápio</a>
    </div>
    <div class="grid grid--cards">
      <?php foreach ($featured as $product): ?>
        <?php require APP_ROOT . '/app/Views/partials/product-card.php'; ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="panel" style="padding:24px;">
      <div class="section-head" style="margin-bottom:0;">
        <div>
          <h2 class="section-title">Destaque de experiência</h2>
          <p class="section-subtitle">Carrinho com subtotal em tempo real, checkout com retirada ou entrega e área administrativa para acompanhar pedidos.</p>
        </div>
      </div>
    </div>
  </div>
</section>
