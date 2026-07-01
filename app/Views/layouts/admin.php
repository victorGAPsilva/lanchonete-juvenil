<?php
use App\Core\Auth;
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="<?= e(csrf_token()) ?>">
  <title><?= e(($title ?? 'Painel Admin') . ' | ' . config('brand')) ?></title>
  <link rel="stylesheet" href="<?= asset('css/app.css') ?>">
  <script defer src="<?= asset('js/app.js') ?>"></script>
</head>
<body>
  <div class="container" style="padding: 20px 0 0;">
    <div class="admin-shell">
      <header class="panel" style="padding: 18px;">
        <div class="site-header__inner" style="padding:0;">
          <div class="brand">
            <div class="brand__mark">J</div>
            <div class="brand__text">
              <span class="brand__title">Juvenil</span>
              <span class="brand__subtitle">Painel administrativo</span>
            </div>
          </div>
          <form action="<?= url('logout') ?>" method="post">
            <?= csrf_field() ?>
            <button class="btn btn--primary" type="submit">Sair</button>
          </form>
        </div>
        <nav class="admin-nav" style="margin-top: 16px;">
          <a href="<?= url('admin') ?>">Dashboard</a>
          <a href="<?= url('admin/produtos') ?>">Produtos</a>
          <a href="<?= url('admin/pedidos') ?>">Pedidos</a>
          <a href="<?= url('admin/configuracoes') ?>">Configurações</a>
        </nav>
      </header>
      <?= $content ?>
    </div>
  </div>
</body>
</html>
