<?php
$stats = $stats ?? ['day' => 0, 'week' => 0, 'month' => 0, 'total' => 0];
?>
<section class="section" style="padding-top:0;">
  <div class="container" style="padding:0;">
    <div class="grid grid--stats">
      <div class="stat"><strong><?= (int) $stats['day'] ?></strong><span>Pedidos hoje</span></div>
      <div class="stat"><strong><?= (int) $stats['week'] ?></strong><span>Últimos 7 dias</span></div>
      <div class="stat"><strong><?= (int) $stats['month'] ?></strong><span>Últimos 30 dias</span></div>
      <div class="stat"><strong><?= money($stats['total']) ?></strong><span>Faturamento bruto</span></div>
    </div>
  </div>
</section>
