<?php
use App\Models\Category;
use App\Models\Setting;

$settings = Setting::all();
$categories = Category::all();
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="<?= e(csrf_token()) ?>">
  <title><?= e(($title ?? config('name')) . ' | ' . config('brand')) ?></title>
  <link rel="stylesheet" href="<?= asset('css/app.css') ?>">
  <script defer src="<?= asset('js/app.js') ?>"></script>
</head>
<body>
  <?php require APP_ROOT . '/app/Views/partials/header.php'; ?>

  <main>
    <?= $content ?>
  </main>

  <?php require APP_ROOT . '/app/Views/partials/footer.php'; ?>

  <a class="whatsapp-float" href="https://wa.me/<?= e($settings['whatsapp'] ?? config('whatsapp')) ?>" target="_blank" rel="noreferrer" aria-label="WhatsApp">
    WA
  </a>
</body>
</html>
