<?php
use App\Models\Category;
use App\Models\Product;

$activeCategory = $_GET['categoria'] ?? '';
$categories = Category::all();
$products = Product::all($activeCategory);
?>
<section class="section">
  <div class="container">
    <div class="section-head">
      <div>
        <h1 class="section-title">Cardápio</h1>
        <p class="section-subtitle">Escolha um item, personalize no checkout e finalize sem sair do celular.</p>
      </div>
    </div>

    <div class="nav-pills" style="margin-bottom:20px;">
      <a class="nav-pill <?= $activeCategory === '' ? 'is-active' : '' ?>" href="<?= url('cardapio') ?>">Todos</a>
      <?php foreach ($categories as $category): ?>
        <a class="nav-pill <?= $activeCategory === $category['slug'] ? 'is-active' : '' ?>" href="<?= url('cardapio?categoria=' . urlencode($category['slug'])) ?>"><?= e($category['name']) ?></a>
      <?php endforeach; ?>
    </div>

    <div class="grid grid--cards">
      <?php foreach ($products as $product): ?>
        <?php require APP_ROOT . '/app/Views/partials/product-card.php'; ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>
