<?php
declare(strict_types=1);

namespace App\Core;

use App\Models\Product;

final class Cart
{
    private const KEY = 'cart_items';

    public static function items(): array
    {
        return Session::get(self::KEY, []);
    }

    public static function count(): int
    {
        $count = 0;

        foreach (self::items() as $item) {
            $count += (int) ($item['quantity'] ?? 0);
        }

        return $count;
    }

    public static function subtotal(): float
    {
        $subtotal = 0.0;

        foreach (self::items() as $item) {
            $subtotal += ((float) ($item['price'] ?? 0)) * ((int) ($item['quantity'] ?? 0));
        }

        return $subtotal;
    }

    public static function add(int $productId, int $quantity = 1, array $options = [], string $notes = ''): array
    {
        $product = Product::find($productId);

        if (!$product) {
            return ['success' => false, 'message' => 'Produto não encontrado.'];
        }

        $items = self::items();
        $key = (string) $productId;

        if (!isset($items[$key])) {
            $items[$key] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => (float) $product['price'],
                'quantity' => 0,
                'options' => $options,
                'notes' => $notes,
            ];
        }

        $items[$key]['quantity'] += max(1, $quantity);
        $items[$key]['options'] = $options;
        $items[$key]['notes'] = $notes;

        Session::put(self::KEY, $items);

        return ['success' => true, 'count' => self::count(), 'subtotal' => self::subtotal()];
    }

    public static function update(int $productId, int $quantity): array
    {
        $items = self::items();
        $key = (string) $productId;

        if (!isset($items[$key])) {
            return ['success' => false];
        }

        if ($quantity <= 0) {
            unset($items[$key]);
        } else {
            $items[$key]['quantity'] = $quantity;
        }

        Session::put(self::KEY, $items);

        return ['success' => true, 'count' => self::count(), 'subtotal' => self::subtotal()];
    }

    public static function remove(int $productId): array
    {
        $items = self::items();
        unset($items[(string) $productId]);
        Session::put(self::KEY, $items);

        return ['success' => true, 'count' => self::count(), 'subtotal' => self::subtotal()];
    }

    public static function clear(): void
    {
        Session::forget(self::KEY);
    }
}
