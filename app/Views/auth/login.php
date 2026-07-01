<section class="section">
  <div class="container">
    <div class="form-card" style="max-width:520px;margin:0 auto;">
      <h1 class="section-title">Login</h1>
      <p class="section-subtitle">Entre para acompanhar seus pedidos e acessar o painel administrativo.</p>
      <form class="form-grid" method="post" action="<?= url($adminLogin ?? 'login') ?>" style="margin-top:18px;">
        <?= csrf_field() ?>
        <div class="field"><label for="email">E-mail</label><input id="email" name="email" type="email" required></div>
        <div class="field"><label for="password">Senha</label><input id="password" name="password" type="password" required></div>
        <button class="btn btn--primary" type="submit">Entrar</button>
      </form>
      <div class="section-divider"></div>
      <a class="btn btn--ghost" href="<?= url('cadastro') ?>">Criar conta</a>
    </div>
  </div>
</section>
