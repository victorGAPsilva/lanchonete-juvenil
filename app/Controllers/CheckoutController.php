<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Cart;
use App\Core\Controller;
use App\Core\Csrf;
use App\Core\Session;
use App\Models\Order;
use App\Models\Setting;

final class CheckoutController extends Controller
{
    public function index(): void
    {
        if (empty(Cart::items())) {
            $this->redirect('cardapio');
        }

        $this->render('checkout/index', ['title' => 'Checkout']);
    }

    public function store(): void
    {
        $this->requirePost();

        if (!Csrf::verify($_POST['_token'] ?? null)) {
            Session::setFlash('error', 'Falha de segurança. Recarregue a página e tente novamente.');
            $this->redirect('checkout');
        }

        if (empty(Cart::items())) {
            Session::setFlash('error', 'Seu carrinho está vazio.');
            $this->redirect('cardapio');
        }

        $data = [
            'customer_name' => trim((string) ($_POST['customer_name'] ?? '')),
            'phone' => trim((string) ($_POST['phone'] ?? '')),
            'delivery_type' => in_array(($_POST['delivery_type'] ?? 'pickup'), ['pickup', 'delivery'], true) ? $_POST['delivery_type'] : 'pickup',
            'payment_method' => in_array(($_POST['payment_method'] ?? 'pix'), ['pix', 'card', 'cash'], true) ? $_POST['payment_method'] : 'pix',
            'change_for' => ($_POST['change_for'] ?? '') !== '' ? (float) $_POST['change_for'] : null,
            'address' => trim((string) ($_POST['address'] ?? '')),
            'district' => trim((string) ($_POST['district'] ?? '')),
            'city' => trim((string) ($_POST['city'] ?? '')),
            'state' => trim((string) ($_POST['state'] ?? '')),
            'zipcode' => trim((string) ($_POST['zipcode'] ?? '')),
            'notes' => trim((string) ($_POST['notes'] ?? '')),
            'subtotal' => Cart::subtotal(),
            'delivery_fee' => ($_POST['delivery_type'] ?? 'pickup') === 'delivery' ? (float) Setting::get('delivery_fee', 0) : 0,
            'items' => Cart::items(),
        ];
        $data['total'] = $data['subtotal'] + $data['delivery_fee'];

        $errors = [];

        if ($data['customer_name'] === '') {
            $errors[] = 'Informe seu nome.';
        }

        if ($data['phone'] === '') {
            $errors[] = 'Informe seu telefone.';
        }

        if ($data['delivery_type'] === 'delivery' && ($data['address'] === '' || $data['district'] === '')) {
            $errors[] = 'Preencha o endereço completo para entrega.';
        }

        if ($errors !== []) {
            Session::setFlash('error', implode(' ', $errors));
            Session::put('old_input', $_POST);
            $this->redirect('checkout');
        }

        $order = Order::create($data);
        Cart::clear();
        Session::forget('old_input');

        $this->render('checkout/success', [
            'title' => 'Pedido confirmado',
            'order' => $order,
            'data' => $data,
        ]);
    }
}
