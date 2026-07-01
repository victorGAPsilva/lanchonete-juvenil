<?php
$settings = $settings ?? App\Models\Setting::all();
?>
<section class="section" style="padding-top:0;">
  <div class="container" style="padding:0;">
    <div class="admin-card">
      <h1 class="admin-title">Configurações</h1>
      <p class="section-subtitle">Horário de funcionamento, taxa de entrega e área atendida.</p>
      <form class="form-grid form-grid--two" method="post" action="<?= url('admin/configuracoes') ?>" style="margin-top:18px;">
        <?= csrf_field() ?>
        <div class="field"><label>Horário de funcionamento</label><input name="opening_hours" value="<?= e($settings['opening_hours'] ?? '') ?>"></div>
        <div class="field"><label>Taxa de entrega</label><input name="delivery_fee" type="number" step="0.01" value="<?= e($settings['delivery_fee'] ?? '') ?>"></div>
        <div class="field"><label>Área de entrega</label><input name="delivery_area" value="<?= e($settings['delivery_area'] ?? '') ?>"></div>
        <div class="field"><label>Telefone</label><input name="phone" value="<?= e($settings['phone'] ?? '') ?>"></div>
        <div class="field"><label>WhatsApp</label><input name="whatsapp" value="<?= e($settings['whatsapp'] ?? '') ?>"></div>
        <div class="field"><label>Endereço</label><input name="address" value="<?= e($settings['address'] ?? '') ?>"></div>
        <div style="grid-column:1/-1;"><button class="btn btn--primary" type="submit">Salvar configurações</button></div>
      </form>
    </div>
  </div>
</section>
