<?php
use App\Core\Cart;

$items = Cart::items();
$subtotal = Cart::subtotal();
?>
<section class="section">
  <div class="container">
    <div class="section-head">
      <div>
        <h1 class="section-title">Checkout</h1>
        <p class="section-subtitle">Escolha retirada ou entrega, forma de pagamento e finalize seu pedido.</p>
      </div>
    </div>

    <div class="cart-layout">
      <form class="form-card" method="post" action="<?= url('checkout') ?>">
        <?= csrf_field() ?>
        <div class="form-grid form-grid--two">
          <div class="field"><label for="customer_name">Nome</label><input id="customer_name" name="customer_name" required value="<?= e(old('customer_name')) ?>"></div>
          <div class="field"><label for="phone">Telefone</label><input id="phone" name="phone" required value="<?= e(old('phone')) ?>"></div>
        </div>

        <div class="form-grid form-grid--two" style="margin-top:14px;">
          <div class="field">
            <label for="delivery_type">Tipo de atendimento</label>
            <select id="delivery_type" name="delivery_type" data-delivery-toggle required>
              <option value="pickup">Retirada no local</option>
              <option value="delivery">Entrega</option>
            </select>
          </div>
          <div class="field">
            <label for="payment_method">Pagamento</label>
            <select id="payment_method" name="payment_method" required>
              <option value="pix">Pix</option>
              <option value="card">Cartão</option>
              <option value="cash">Dinheiro</option>
            </select>
          </div>
        </div>

        <div data-delivery-fields hidden style="margin-top:14px;">
          <div class="form-grid form-grid--three">
            <div class="field"><label for="address">Endereço</label><input id="address" name="address"></div>
            <div class="field"><label for="district">Bairro</label><input id="district" name="district"></div>
            <div class="field"><label for="zipcode">CEP</label><input id="zipcode" name="zipcode"></div>
          </div>
          <div class="form-grid form-grid--three" style="margin-top:14px;">
            <div class="field"><label for="city">Cidade</label><input id="city" name="city"></div>
            <div class="field"><label for="state">UF</label><input id="state" name="state"></div>
            <div class="field"><label for="change_for">Troco para</label><input id="change_for" name="change_for" type="number" step="0.01" min="0"></div>
          </div>
        </div>

        <div class="field" style="margin-top:14px;">
          <label for="notes">Observações</label>
          <textarea id="notes" name="notes" rows="4" placeholder="Ex.: sem cebola, ponto da carne, talheres..."></textarea>
        </div>

        <div class="alert alert--success" style="margin-top:18px;">Subtotal atual: <strong><?= money($subtotal) ?></strong></div>
        <button class="btn btn--primary" type="submit">Finalizar pedido</button>
      </form>

      <aside class="panel cart-summary" style="padding:20px;">
        <h2 class="card-title">Itens do pedido</h2>
        <?php foreach ($items as $item): ?>
          <div class="section-divider"></div>
          <div style="display:flex;justify-content:space-between;gap:12px;">
            <div>
              <strong><?= e($item['name']) ?></strong>
              <p class="section-subtitle" style="margin:6px 0 0;"><?= (int) $item['quantity'] ?>x <?= money($item['price']) ?></p>
            </div>
            <strong><?= money($item['price'] * $item['quantity']) ?></strong>
          </div>
        <?php endforeach; ?>
      </aside>
    </div>
  </div>
</section>
