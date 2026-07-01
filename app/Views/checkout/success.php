<section class="section">
  <div class="container">
    <div class="panel" style="padding:28px; text-align:center;">
      <p class="chip chip--fresh">Pedido confirmado</p>
      <h1 class="section-title">Seu pedido foi recebido</h1>
      <p class="section-subtitle">Código <?= e($order['code'] ?? '') ?>. Em breve a equipe vai atualizar o status no painel.</p>
      <div class="hero__actions" style="justify-content:center;">
        <a class="btn btn--primary" href="<?= url('acompanhar-pedido?code=' . urlencode($order['code'] ?? '')) ?>">Acompanhar pedido</a>
        <a class="btn btn--ghost" href="<?= url('cardapio') ?>">Fazer novo pedido</a>
      </div>
    </div>
  </div>
</section>
