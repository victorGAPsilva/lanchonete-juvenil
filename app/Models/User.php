<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

final class User
{
    public static function findByEmail(string $email): ?array
    {
        if (!empty($_SESSION['demo_users'])) {
            foreach ($_SESSION['demo_users'] as $user) {
                if (strcasecmp($user['email'], $email) === 0) {
                    return $user;
                }
            }
        }

        $pdo = Database::pdo();

        if ($pdo instanceof PDO) {
            $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE email = :email LIMIT 1');
            $stmt->execute(['email' => $email]);
            $row = $stmt->fetch();

            if ($row) {
                return $row;
            }
        }

        foreach (DemoData::users() as $user) {
            if (strcasecmp($user['email'], $email) === 0) {
                return $user;
            }
        }

        return null;
    }

    public static function create(array $data): bool
    {
        $pdo = Database::pdo();

        if (!$pdo instanceof PDO) {
            $users = array_values($_SESSION['demo_users'] ?? DemoData::users());
            $users[] = [
                'id' => count($users) + 1,
                'name' => trim((string) $data['name']),
                'email' => trim((string) $data['email']),
                'password' => password_hash((string) $data['password'], PASSWORD_DEFAULT),
                'role' => 'customer',
            ];
            $_SESSION['demo_users'] = $users;

            return true;
        }

        $stmt = $pdo->prepare('INSERT INTO usuarios (name, email, password, role, created_at, updated_at) VALUES (:name, :email, :password, :role, NOW(), NOW())');

        return $stmt->execute([
            'name' => trim((string) $data['name']),
            'email' => trim((string) $data['email']),
            'password' => password_hash((string) $data['password'], PASSWORD_DEFAULT),
            'role' => 'customer',
        ]);
    }
}
