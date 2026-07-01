<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Controller;
use App\Models\Order;

final class DashboardController extends Controller
{
    public function index(): void
    {
        Auth::requireAdmin();

        $this->render('admin/dashboard', [
            'title' => 'Dashboard',
            'stats' => Order::stats(),
        ], 'layouts/admin');
    }
}
