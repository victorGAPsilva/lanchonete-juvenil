<?php
use App\Core\Cart;

$items = Cart::items();
$subtotal = Cart::subtotal();
?>
<section class="section">
  <div class="container">
    <div class="section-head">
      <div>
        <h1 class="section-title">Carrinho</h1>
        <p class="section-subtitle">Ajuste quantidades e siga para o checkout sem perder o ritmo do pedido.</p>
      </div>
    </div>

    <div class="cart-layout">
      <div class="panel" style="padding:20px;">
        <?php if (empty($items)): ?>
          <div style="padding:20px 0;">Seu carrinho está vazio.</div>
        <?php else: ?>
          <?php foreach ($items as $item): ?>
            <div class="cart-item">
              <div class="cart-item__thumb">🍔</div>
              <div class="cart-item__details">
                <h3><?= e($item['name']) ?></h3>
                <div class="chip-row"><span class="chip"><?= money($item['price']) ?></span></div>
                <?php if (!empty($item['notes'])): ?><p class="section-subtitle"><?= e($item['notes']) ?></p><?php endif; ?>
              </div>
              <div style="display:grid; gap:8px; justify-items:end;">
                <input data-cart-quantity data-product-id="<?= (int) $item['id'] ?>" type="number" min="1" value="<?= (int) $item['quantity'] ?>" style="width:88px;">
                <button class="btn btn--ghost" type="button" onclick="fetch('/cart/remove',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-Token':document.querySelector('meta[name=\'csrf-token\']').content},body:JSON.stringify({product_id:<?= (int) $item['id'] ?>})}).then(()=>window.location.reload())">Remover</button>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <aside class="panel cart-summary" style="padding:20px;">
        <h2 class="card-title">Resumo</h2>
        <div class="section-divider"></div>
        <div style="display:flex;justify-content:space-between;margin-bottom:12px;">
          <span>Subtotal</span>
          <strong data-cart-subtotal><?= money($subtotal) ?></strong>
        </div>
        <a class="btn btn--primary" style="width:100%;" href="<?= url('checkout') ?>">Ir para checkout</a>
      </aside>
    </div>
  </div>
</section>
