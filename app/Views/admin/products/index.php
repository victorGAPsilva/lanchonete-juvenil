<?php
use App\Models\Category;
use App\Models\Product;

$products = $products ?? Product::all();
$categories = Category::all();
$editing = $editing ?? null;
?>
<section class="section" style="padding-top:0;">
  <div class="container" style="padding:0;">
    <div class="grid" style="grid-template-columns:1fr; gap:20px;">
      <div class="admin-card">
        <h1 class="admin-title">Produtos</h1>
        <p class="section-subtitle">CRUD base para cardápio, disponibilidade, destaque e upload de foto.</p>
        <form class="form-grid form-grid--three" method="post" action="<?= url('admin/produtos') ?>" style="margin-top:18px;">
          <?= csrf_field() ?>
          <input type="hidden" name="id" value="<?= e($editing['id'] ?? '') ?>">
          <div class="field"><label>Categoria</label><select name="category_id" required><?php foreach ($categories as $category): ?><option value="<?= (int) $category['id'] ?>"><?= e($category['name']) ?></option><?php endforeach; ?></select></div>
          <div class="field"><label>Nome</label><input name="name" required value="<?= e($editing['name'] ?? '') ?>"></div>
          <div class="field"><label>Slug</label><input name="slug" required value="<?= e($editing['slug'] ?? '') ?>"></div>
          <div class="field" style="grid-column:1/-1;"><label>Descrição</label><textarea name="description" rows="4" required><?= e($editing['description'] ?? '') ?></textarea></div>
          <div class="field"><label>Preço</label><input name="price" type="number" step="0.01" min="0" required value="<?= e($editing['price'] ?? '') ?>"></div>
          <div class="field"><label>Imagem</label><input name="image" placeholder="/assets/images/produto.jpg" value="<?= e($editing['image'] ?? '') ?>"></div>
          <div class="field"><label>Disponível</label><select name="available"><option value="1">Sim</option><option value="0">Não</option></select></div>
          <div class="field"><label>Destaque</label><select name="featured"><option value="1">Sim</option><option value="0">Não</option></select></div>
          <div class="field"><label>Promoção</label><select name="promo"><option value="1">Sim</option><option value="0">Não</option></select></div>
          <div class="field"><label>Fresco</label><select name="fresh"><option value="1">Sim</option><option value="0">Não</option></select></div>
          <div style="grid-column:1/-1;">
            <button class="btn btn--primary" type="submit">Salvar produto</button>
          </div>
        </form>
      </div>

      <div class="admin-card">
        <h2 class="card-title">Lista de produtos</h2>
        <div class="table-wrap">
          <table>
            <thead><tr><th>Produto</th><th>Preço</th><th>Status</th><th>Ações</th></tr></thead>
            <tbody>
              <?php foreach ($products as $product): ?>
                <tr>
                  <td><?= e($product['name']) ?></td>
                  <td><?= money($product['price']) ?></td>
                  <td><?= !empty($product['available']) ? 'Disponível' : 'Oculto' ?></td>
                  <td>
                    <form method="post" action="<?= url('admin/produtos/excluir') ?>" onsubmit="return confirm('Excluir este produto?');">
                      <?= csrf_field() ?>
                      <input type="hidden" name="id" value="<?= (int) $product['id'] ?>">
                      <button class="btn btn--ghost" type="submit">Excluir</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
