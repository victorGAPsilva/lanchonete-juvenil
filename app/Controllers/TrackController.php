<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Order;

final class TrackController extends Controller
{
    public function show(): void
    {
        $code = trim((string) ($_GET['code'] ?? ''));

        $this->render('track/show', [
            'title' => 'Acompanhar pedido',
            'order' => $code !== '' ? Order::findByCode($code) : Order::latest(),
        ]);
    }
}
