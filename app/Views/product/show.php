<?php
if (empty($product)) {
    echo '<section class="section"><div class="container"><div class="panel" style="padding:24px;">Produto não encontrado.</div></div></section>';
    return;
}

$emoji = match ((int) ($product['category_id'] ?? 1)) {
    1 => '🍔',
    2 => '🥤',
    3 => '🍟',
    default => '🍨',
};
?>
<section class="section">
  <div class="container">
    <div class="grid" style="grid-template-columns:1fr; gap:20px;">
      <div class="panel" style="overflow:hidden;">
        <div class="hero__grid" style="padding:24px;">
          <div>
            <div class="chip-row">
              <?php if (!empty($product['promo'])): ?><span class="chip chip--promo">Promoção</span><?php endif; ?>
              <?php if (!empty($product['fresh'])): ?><span class="chip chip--fresh">Fresco</span><?php endif; ?>
            </div>
            <h1 class="section-title" style="margin-top:16px;"><?= e($product['name']) ?></h1>
            <p class="section-subtitle"><?= e($product['description']) ?></p>
            <p class="price" style="font-size:2rem;margin:18px 0 0;"><?= money($product['price']) ?></p>
            <div class="hero__actions">
              <button class="btn btn--primary" type="button" data-cart-add data-product-id="<?= (int) $product['id'] ?>">Adicionar ao carrinho</button>
              <a class="btn btn--ghost" href="<?= url('cardapio') ?>">Voltar ao cardápio</a>
            </div>
          </div>
          <div class="product-thumb" style="min-height:320px;border-radius:28px;"><span class="product-thumb__emoji" style="font-size:6rem;"><?= $emoji ?></span></div>
        </div>
      </div>

      <div class="panel" style="padding:24px;">
        <h2 class="card-title">Personalização</h2>
        <p class="section-subtitle">Exemplos de opções suportadas no checkout: sem cebola, ponto da carne, adicionais pagos e observações.</p>
        <div class="chip-row" style="margin-top:14px;">
          <span class="chip">Sem cebola</span>
          <span class="chip">Ao ponto</span>
          <span class="chip">+ Queijo</span>
          <span class="chip">+ Bacon</span>
        </div>
      </div>
    </div>
  </div>
</section>
