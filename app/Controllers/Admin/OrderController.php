<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Csrf;
use App\Core\Session;
use App\Models\Order;

final class OrderController extends Controller
{
    public function index(): void
    {
        Auth::requireAdmin();

        $this->render('admin/orders/index', [
            'title' => 'Pedidos',
            'orders' => Order::all(),
        ], 'layouts/admin');
    }

    public function updateStatus(): void
    {
        Auth::requireAdmin();
        $this->requirePost();

        if (!Csrf::verify($_POST['_token'] ?? null)) {
            Session::setFlash('error', 'Token inválido.');
            $this->redirect('admin/pedidos');
        }

        Order::updateStatus(trim((string) ($_POST['code'] ?? '')), trim((string) ($_POST['status'] ?? 'received')));
        Session::setFlash('success', 'Status atualizado.');
        $this->redirect('admin/pedidos');
    }
}
