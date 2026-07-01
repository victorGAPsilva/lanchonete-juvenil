<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Product;

final class ProductController extends Controller
{
    public function show(): void
    {
        $id = (int) ($_GET['id'] ?? 0);

        $this->render('product/show', [
            'title' => 'Produto',
            'product' => $id > 0 ? Product::find($id) : null,
        ]);
    }
}
