<?php
$settings = App\Models\Setting::all();
?>
<footer class="footer">
  <div class="container">
    <div class="footer__grid">
      <div>
        <h3 class="section-title" style="color:#fff;margin-bottom:8px;">Lanchonete Juvenil</h3>
        <p style="margin:0;max-width:40ch;opacity:.92;">Pedidos online com identidade marcante, navegação rápida e experiência mobile-first para vender mais no WhatsApp e no balcão.</p>
      </div>
      <div>
        <strong>Contato</strong>
        <p><a href="tel:<?= e(preg_replace('/\D+/', '', $settings['phone'] ?? config('support_phone'))) ?>"><?= e($settings['phone'] ?? config('support_phone')) ?></a></p>
        <p><a href="https://wa.me/<?= e($settings['whatsapp'] ?? config('whatsapp')) ?>" target="_blank" rel="noreferrer">WhatsApp</a></p>
      </div>
      <div>
        <strong>Endereço</strong>
        <p><?= e($settings['address'] ?? '') ?></p>
      </div>
      <div>
        <strong>Horário</strong>
        <p><?= e($settings['opening_hours'] ?? '') ?></p>
      </div>
    </div>
  </div>
</footer>
