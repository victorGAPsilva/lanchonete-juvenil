<?php
$orders = App\Models\Order::all();
$latest = $orders[0] ?? [];
?>
<section class="section">
  <div class="container">
    <div class="section-head">
      <div>
        <h1 class="section-title">Acompanhar pedido</h1>
        <p class="section-subtitle">Visão simples do status atual e do último pedido registrado.</p>
      </div>
    </div>

    <div class="grid" style="grid-template-columns:1fr; gap:16px;">
      <div class="panel" style="padding:24px;">
        <h2 class="card-title">Status do pedido <?= e($latest['code'] ?? 'JU-0000') ?></h2>
        <p class="section-subtitle">Recebido → Em preparo → Saiu para entrega/Pronto para retirada → Concluído</p>
        <div class="chip-row" style="margin-top:16px;">
          <span class="status status--received">Recebido</span>
          <span class="status status--preparing">Em preparo</span>
          <span class="status status--ready">Pronto para retirada</span>
          <span class="status status--on_the_way">Saiu para entrega</span>
          <span class="status status--completed">Concluído</span>
        </div>
      </div>
      <div class="panel" style="padding:24px;">
        <strong>Último pedido</strong>
        <p class="section-subtitle" style="margin-top:8px;">Cliente: <?= e($latest['customer_name'] ?? '—') ?></p>
        <p class="section-subtitle">Status: <?= e($latest['status'] ?? 'received') ?></p>
      </div>
    </div>
  </div>
</section>
