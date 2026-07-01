<section class="section">
  <div class="container">
    <div class="form-card" style="max-width:620px;margin:0 auto;">
      <h1 class="section-title">Cadastro</h1>
      <p class="section-subtitle">Crie uma conta para acelerar pedidos futuros e registrar histórico.</p>
      <form class="form-grid form-grid--two" method="post" action="<?= url('cadastro') ?>" style="margin-top:18px;">
        <?= csrf_field() ?>
        <div class="field"><label for="name">Nome</label><input id="name" name="name" required></div>
        <div class="field"><label for="email">E-mail</label><input id="email" name="email" type="email" required></div>
        <div class="field"><label for="password">Senha</label><input id="password" name="password" type="password" required></div>
        <div class="field"><label for="password_confirmation">Confirmar senha</label><input id="password_confirmation" name="password_confirmation" type="password" required></div>
        <div style="grid-column:1/-1;">
          <button class="btn btn--primary" type="submit">Criar conta</button>
        </div>
      </form>
    </div>
  </div>
</section>
