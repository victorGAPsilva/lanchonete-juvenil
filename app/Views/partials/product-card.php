<?php
$emoji = match ((int) ($product['category_id'] ?? 1)) {
    1 => '🍔',
    2 => '🥤',
    3 => '🍟',
    default => '🍨',
};
?>
<article class="card">
  <a href="<?= url('produto?id=' . (int) $product['id']) ?>">
    <div class="product-thumb"><span class="product-thumb__emoji"><?= $emoji ?></span></div>
  </a>
  <div class="card-body">
    <div class="chip-row">
      <?php if (!empty($product['promo'])): ?><span class="chip chip--promo">Promoção</span><?php endif; ?>
      <?php if (!empty($product['fresh'])): ?><span class="chip chip--fresh">Fresco</span><?php endif; ?>
    </div>
    <h3 class="card-title"><?= e($product['name']) ?></h3>
    <p class="section-subtitle"><?= e($product['description']) ?></p>
    <div class="card-meta" style="justify-content:space-between;margin-top:14px;">
      <strong class="price"><?= money($product['price']) ?></strong>
      <button class="btn btn--primary" type="button" data-cart-add data-product-id="<?= (int) $product['id'] ?>">Adicionar</button>
    </div>
  </div>
</article>
