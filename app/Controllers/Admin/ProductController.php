<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Csrf;
use App\Core\Session;
use App\Models\Category;
use App\Models\Product;

final class ProductController extends Controller
{
    public function index(): void
    {
        Auth::requireAdmin();

        $this->render('admin/products/index', [
            'title' => 'Produtos',
            'products' => Product::all(),
            'categories' => Category::all(),
        ], 'layouts/admin');
    }

    public function store(): void
    {
        Auth::requireAdmin();
        $this->requirePost();

        if (!Csrf::verify($_POST['_token'] ?? null)) {
            Session::setFlash('error', 'Token inválido.');
            $this->redirect('admin/produtos');
        }

        Product::save($_POST);
        Session::setFlash('success', 'Produto salvo com sucesso.');
        $this->redirect('admin/produtos');
    }

    public function delete(): void
    {
        Auth::requireAdmin();
        $this->requirePost();

        if (!Csrf::verify($_POST['_token'] ?? null)) {
            Session::setFlash('error', 'Token inválido.');
            $this->redirect('admin/produtos');
        }

        Product::delete((int) ($_POST['id'] ?? 0));
        Session::setFlash('success', 'Produto removido.');
        $this->redirect('admin/produtos');
    }
}
