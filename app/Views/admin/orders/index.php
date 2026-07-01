<?php
$orders = $orders ?? App\Models\Order::all();
?>
<section class="section" style="padding-top:0;">
  <div class="container" style="padding:0;">
    <div class="admin-card">
      <h1 class="admin-title">Pedidos</h1>
      <p class="section-subtitle">Acompanhe o status em tempo real e altere o fluxo operacional da cozinha e entrega.</p>
      <div class="table-wrap" style="margin-top:16px;">
        <table>
          <thead><tr><th>Código</th><th>Cliente</th><th>Status</th><th>Total</th><th>Alterar</th></tr></thead>
          <tbody>
            <?php foreach ($orders as $order): ?>
              <tr>
                <td><?= e($order['code']) ?></td>
                <td><?= e($order['customer_name']) ?></td>
                <td><span class="status status--<?= e($order['status']) ?>"><?= e(str_replace('_', ' ', $order['status'])) ?></span></td>
                <td><?= money($order['total']) ?></td>
                <td>
                  <form class="chip-row" method="post" action="<?= url('admin/pedidos/status') ?>">
                    <?= csrf_field() ?>
                    <input type="hidden" name="code" value="<?= e($order['code']) ?>">
                    <select name="status">
                      <option value="received">Recebido</option>
                      <option value="preparing">Em preparo</option>
                      <option value="on_the_way">Saiu para entrega</option>
                      <option value="ready">Pronto para retirada</option>
                      <option value="completed">Concluído</option>
                      <option value="cancelled">Cancelado</option>
                    </select>
                    <button class="btn btn--primary" type="submit">Salvar</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
