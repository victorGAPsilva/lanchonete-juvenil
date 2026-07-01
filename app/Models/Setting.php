<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

final class Setting
{
    public static function all(): array
    {
        if (!empty($_SESSION['demo_settings'])) {
            return array_merge(DemoData::settings(), $_SESSION['demo_settings']);
        }

        $pdo = Database::pdo();

        if ($pdo instanceof PDO) {
            $stmt = $pdo->query('SELECT `key`, `value` FROM configuracoes');
            $settings = [];

            foreach ($stmt->fetchAll() as $row) {
                $settings[$row['key']] = $row['value'];
            }

            if (!empty($settings)) {
                return $settings;
            }
        }

        return DemoData::settings();
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        $settings = self::all();

        return $settings[$key] ?? $default;
    }

    public static function saveMany(array $settings): bool
    {
        $pdo = Database::pdo();

        if (!$pdo instanceof PDO) {
            $_SESSION['demo_settings'] = array_merge((array) ($_SESSION['demo_settings'] ?? []), $settings);

            return true;
        }

        $stmt = $pdo->prepare('INSERT INTO configuracoes (`key`, `value`, updated_at) VALUES (:key, :value, NOW()) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`), updated_at = NOW()');

        foreach ($settings as $key => $value) {
            $stmt->execute(['key' => $key, 'value' => (string) $value]);
        }

        return true;
    }
}
