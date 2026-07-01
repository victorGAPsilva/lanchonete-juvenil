<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Cart;
use App\Core\Controller;
use App\Core\Csrf;
use App\Core\Session;

final class CartController extends Controller
{
    public function index(): void
    {
        $this->render('cart/index', ['title' => 'Carrinho']);
    }

    public function add(): void
    {
        $this->guardJson();

        $payload = $this->jsonPayload();
        $result = Cart::add((int) ($payload['product_id'] ?? 0), (int) ($payload['quantity'] ?? 1));

        $this->json($this->formatResponse($result));
    }

    public function update(): void
    {
        $this->guardJson();

        $payload = $this->jsonPayload();
        $result = Cart::update((int) ($payload['product_id'] ?? 0), (int) ($payload['quantity'] ?? 1));

        $this->json($this->formatResponse($result));
    }

    public function remove(): void
    {
        $this->guardJson();

        $payload = $this->jsonPayload();
        $result = Cart::remove((int) ($payload['product_id'] ?? 0));

        $this->json($this->formatResponse($result));
    }

    public function clear(): void
    {
        $this->guardJson();
        Cart::clear();

        $this->json(['success' => true, 'count' => 0, 'subtotal' => 0, 'subtotal_formatted' => money(0)]);
    }

    private function guardJson(): void
    {
        $token = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? ($_POST['_token'] ?? null);

        if (!Csrf::verify($token)) {
            $this->json(['success' => false, 'message' => 'Token CSRF inválido.'], 419);
            exit;
        }
    }

    private function jsonPayload(): array
    {
        $raw = file_get_contents('php://input');
        $data = json_decode($raw ?: '[]', true);

        return is_array($data) ? $data : [];
    }

    private function formatResponse(array $result): array
    {
        return [
            'success' => (bool) ($result['success'] ?? false),
            'count' => (int) ($result['count'] ?? Cart::count()),
            'subtotal' => (float) ($result['subtotal'] ?? Cart::subtotal()),
            'subtotal_formatted' => money((float) ($result['subtotal'] ?? Cart::subtotal())),
            'message' => $result['message'] ?? null,
        ];
    }
}
