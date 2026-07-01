<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

final class Product
{
    public static function all(?string $category = null): array
    {
        $pdo = Database::pdo();

        if (!empty($_SESSION['demo_products'])) {
            $products = array_values($_SESSION['demo_products']);

            if ($category === null || $category === '') {
                return $products;
            }

            $categories = DemoData::categories();
            $categoryId = null;

            foreach ($categories as $item) {
                if ($item['slug'] === $category) {
                    $categoryId = $item['id'];
                    break;
                }
            }

            return array_values(array_filter($products, static fn (array $product): bool => (int) $product['category_id'] === (int) $categoryId));
        }

        if ($pdo instanceof PDO) {
            $sql = 'SELECT p.*, c.name AS category_name, c.slug AS category_slug FROM produtos p INNER JOIN categorias c ON c.id = p.category_id WHERE p.available = 1';
            $params = [];

            if ($category !== null && $category !== '') {
                $sql .= ' AND c.slug = :category';
                $params['category'] = $category;
            }

            $sql .= ' ORDER BY p.featured DESC, p.name';
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $rows = $stmt->fetchAll();

            if (!empty($rows)) {
                return $rows;
            }
        }

        $products = DemoData::products();

        if ($category === null || $category === '') {
            return $products;
        }

        $categories = DemoData::categories();
        $categoryId = null;

        foreach ($categories as $item) {
            if ($item['slug'] === $category) {
                $categoryId = $item['id'];
                break;
            }
        }

        return array_values(array_filter($products, static fn (array $product): bool => (int) $product['category_id'] === (int) $categoryId));
    }

    public static function featured(): array
    {
        return array_values(array_filter(self::all(), static fn (array $product): bool => (bool) ($product['featured'] ?? false)));
    }

    public static function find(int $id): ?array
    {
        if (!empty($_SESSION['demo_products'])) {
            foreach ($_SESSION['demo_products'] as $product) {
                if ((int) $product['id'] === $id) {
                    return $product;
                }
            }
        }

        $pdo = Database::pdo();

        if ($pdo instanceof PDO) {
            $stmt = $pdo->prepare('SELECT p.*, c.name AS category_name, c.slug AS category_slug FROM produtos p INNER JOIN categorias c ON c.id = p.category_id WHERE p.id = :id LIMIT 1');
            $stmt->execute(['id' => $id]);
            $row = $stmt->fetch();

            if ($row) {
                return $row;
            }
        }

        foreach (DemoData::products() as $product) {
            if ((int) $product['id'] === $id) {
                return $product;
            }
        }

        return null;
    }

    public static function save(array $data): bool
    {
        $pdo = Database::pdo();

        if (!$pdo instanceof PDO) {
            $products = array_values($_SESSION['demo_products'] ?? DemoData::products());
            $nextId = 1;

            foreach ($products as $product) {
                $nextId = max($nextId, ((int) $product['id']) + 1);
            }

            $payload = [
                'id' => (int) ($data['id'] ?? $nextId),
                'category_id' => (int) $data['category_id'],
                'name' => trim((string) $data['name']),
                'slug' => trim((string) $data['slug']),
                'description' => trim((string) $data['description']),
                'price' => (float) $data['price'],
                'featured' => !empty($data['featured']) ? 1 : 0,
                'promo' => !empty($data['promo']) ? 1 : 0,
                'fresh' => !empty($data['fresh']) ? 1 : 0,
                'available' => !empty($data['available']) ? 1 : 0,
                'image' => trim((string) ($data['image'] ?? '')) ?: null,
            ];

            $updated = false;

            foreach ($products as $index => $product) {
                if ((int) $product['id'] === $payload['id']) {
                    $products[$index] = $payload;
                    $updated = true;
                    break;
                }
            }

            if (!$updated) {
                $products[] = $payload;
            }

            $_SESSION['demo_products'] = $products;

            return true;
        }

        $id = (int) ($data['id'] ?? 0);
        $payload = [
            'category_id' => (int) $data['category_id'],
            'name' => trim((string) $data['name']),
            'slug' => trim((string) $data['slug']),
            'description' => trim((string) $data['description']),
            'price' => (float) $data['price'],
            'featured' => !empty($data['featured']) ? 1 : 0,
            'promo' => !empty($data['promo']) ? 1 : 0,
            'fresh' => !empty($data['fresh']) ? 1 : 0,
            'available' => !empty($data['available']) ? 1 : 0,
            'image' => trim((string) ($data['image'] ?? '')) ?: null,
        ];

        if ($id > 0) {
            $payload['id'] = $id;
            $stmt = $pdo->prepare('UPDATE produtos SET category_id = :category_id, name = :name, slug = :slug, description = :description, price = :price, featured = :featured, promo = :promo, fresh = :fresh, available = :available, image = :image, updated_at = NOW() WHERE id = :id');
        } else {
            $stmt = $pdo->prepare('INSERT INTO produtos (category_id, name, slug, description, price, featured, promo, fresh, available, image, created_at, updated_at) VALUES (:category_id, :name, :slug, :description, :price, :featured, :promo, :fresh, :available, :image, NOW(), NOW())');
        }

        return $stmt->execute($payload);
    }

    public static function delete(int $id): bool
    {
        $pdo = Database::pdo();

        if (!$pdo instanceof PDO) {
            $products = array_values($_SESSION['demo_products'] ?? DemoData::products());
            $_SESSION['demo_products'] = array_values(array_filter($products, static fn (array $product): bool => (int) $product['id'] !== $id));

            return true;
        }

        $stmt = $pdo->prepare('DELETE FROM produtos WHERE id = :id');

        return $stmt->execute(['id' => $id]);
    }
}
