<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

final class Category
{
    public static function all(): array
    {
        $pdo = Database::pdo();

        if ($pdo instanceof PDO) {
            $stmt = $pdo->query('SELECT id, name, slug FROM categorias ORDER BY sort_order, name');
            $rows = $stmt->fetchAll();

            if (!empty($rows)) {
                return $rows;
            }
        }

        return DemoData::categories();
    }
}
