<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Category;
use App\Models\Product;

final class MenuController extends Controller
{
    public function index(): void
    {
        $category = trim((string) ($_GET['categoria'] ?? ''));

        $this->render('menu/index', [
            'title' => 'Cardápio',
            'categories' => Category::all(),
            'products' => Product::all($category),
            'activeCategory' => $category,
        ]);
    }
}
