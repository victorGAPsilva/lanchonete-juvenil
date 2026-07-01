<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

final class Order
{
    public static function all(): array
    {
        if (!empty($_SESSION['demo_orders'])) {
            return array_values($_SESSION['demo_orders']);
        }

        $pdo = Database::pdo();

        if ($pdo instanceof PDO) {
            $stmt = $pdo->query('SELECT * FROM pedidos ORDER BY created_at DESC LIMIT 50');
            $rows = $stmt->fetchAll();

            if (!empty($rows)) {
                return $rows;
            }
        }

        return DemoData::orders();
    }

    public static function latest(): array
    {
        return self::all()[0] ?? [];
    }

    public static function create(array $data): array
    {
        $pdo = Database::pdo();
        $code = 'JU-' . random_int(1000, 9999);

        if ($pdo instanceof PDO) {
            $stmt = $pdo->prepare('INSERT INTO pedidos (code, user_id, customer_name, phone, delivery_type, payment_method, change_for, address, district, city, state, zipcode, notes, subtotal, delivery_fee, total, status, created_at, updated_at) VALUES (:code, :user_id, :customer_name, :phone, :delivery_type, :payment_method, :change_for, :address, :district, :city, :state, :zipcode, :notes, :subtotal, :delivery_fee, :total, :status, NOW(), NOW())');
            $stmt->execute([
                'code' => $code,
                'user_id' => $data['user_id'] ?? null,
                'customer_name' => $data['customer_name'],
                'phone' => $data['phone'] ?? '',
                'delivery_type' => $data['delivery_type'],
                'payment_method' => $data['payment_method'],
                'change_for' => $data['change_for'] ?? null,
                'address' => $data['address'] ?? null,
                'district' => $data['district'] ?? null,
                'city' => $data['city'] ?? null,
                'state' => $data['state'] ?? null,
                'zipcode' => $data['zipcode'] ?? null,
                'notes' => $data['notes'] ?? null,
                'subtotal' => $data['subtotal'],
                'delivery_fee' => $data['delivery_fee'],
                'total' => $data['total'],
                'status' => 'received',
            ]);

            $orderId = (int) $pdo->lastInsertId();
            $itemStmt = $pdo->prepare('INSERT INTO itens_pedido (order_id, product_id, product_name, unit_price, quantity, options_json, notes, created_at, updated_at) VALUES (:order_id, :product_id, :product_name, :unit_price, :quantity, :options_json, :notes, NOW(), NOW())');

            foreach ($data['items'] as $item) {
                $itemStmt->execute([
                    'order_id' => $orderId,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'unit_price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'options_json' => json_encode($item['options'] ?? [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                    'notes' => $item['notes'] ?? '',
                ]);
            }

            return ['code' => $code, 'id' => $orderId];
        }

        $orders = $_SESSION['demo_orders'] ?? DemoData::orders();
        $nextId = count($orders) + 1;
        $record = [
            'id' => $nextId,
            'code' => $code,
            'customer_name' => $data['customer_name'],
            'status' => 'received',
            'payment_method' => $data['payment_method'],
            'delivery_type' => $data['delivery_type'],
            'total' => $data['total'],
            'created_at' => date('Y-m-d H:i:s'),
        ];
        array_unshift($orders, $record);
        $_SESSION['demo_orders'] = $orders;

        return ['code' => $code, 'id' => $nextId];
    }

    public static function findByCode(string $code): ?array
    {
        foreach (self::all() as $order) {
            if (($order['code'] ?? '') === $code) {
                return $order;
            }
        }

        return null;
    }

    public static function updateStatus(string $code, string $status): bool
    {
        $pdo = Database::pdo();

        if (!$pdo instanceof PDO) {
            $orders = array_values($_SESSION['demo_orders'] ?? DemoData::orders());

            foreach ($orders as $index => $order) {
                if (($order['code'] ?? '') === $code) {
                    $orders[$index]['status'] = $status;
                    $_SESSION['demo_orders'] = $orders;

                    return true;
                }
            }

            return false;
        }

        $stmt = $pdo->prepare('UPDATE pedidos SET status = :status, updated_at = NOW() WHERE code = :code');

        return $stmt->execute(['code' => $code, 'status' => $status]);
    }

    public static function stats(): array
    {
        $orders = self::all();
        $today = date('Y-m-d');
        $total = 0.0;
        $day = 0;
        $week = 0;
        $month = 0;

        foreach ($orders as $order) {
            $orderDate = substr((string) ($order['created_at'] ?? ''), 0, 10);
            $total += (float) ($order['total'] ?? 0);

            if ($orderDate === $today) {
                $day++;
            }

            if (strtotime((string) ($order['created_at'] ?? 'now')) >= strtotime('-7 days')) {
                $week++;
            }

            if (strtotime((string) ($order['created_at'] ?? 'now')) >= strtotime('-30 days')) {
                $month++;
            }
        }

        return compact('day', 'week', 'month', 'total');
    }
}
