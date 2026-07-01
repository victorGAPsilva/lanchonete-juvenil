<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Csrf;
use App\Core\Session;
use App\Models\Setting;

final class SettingsController extends Controller
{
    public function index(): void
    {
        Auth::requireAdmin();

        $this->render('admin/settings/index', [
            'title' => 'Configurações',
            'settings' => Setting::all(),
        ], 'layouts/admin');
    }

    public function store(): void
    {
        Auth::requireAdmin();
        $this->requirePost();

        if (!Csrf::verify($_POST['_token'] ?? null)) {
            Session::setFlash('error', 'Token inválido.');
            $this->redirect('admin/configuracoes');
        }

        Setting::saveMany([
            'opening_hours' => trim((string) ($_POST['opening_hours'] ?? '')),
            'delivery_fee' => trim((string) ($_POST['delivery_fee'] ?? '0')),
            'delivery_area' => trim((string) ($_POST['delivery_area'] ?? '')),
            'phone' => trim((string) ($_POST['phone'] ?? '')),
            'whatsapp' => trim((string) ($_POST['whatsapp'] ?? '')),
            'address' => trim((string) ($_POST['address'] ?? '')),
        ]);

        Session::setFlash('success', 'Configurações salvas.');
        $this->redirect('admin/configuracoes');
    }
}
