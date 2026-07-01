<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Csrf;
use App\Core\Session;
use App\Models\User;

final class AuthController extends Controller
{
    public function showLogin(): void
    {
        $this->render('auth/login', ['title' => 'Login']);
    }

    public function showAdminLogin(): void
    {
        $this->render('auth/login', ['title' => 'Login Admin', 'adminLogin' => 'admin/login']);
    }

    public function login(): void
    {
        $this->processLogin('login');
    }

    public function adminLogin(): void
    {
        $this->processLogin('admin/login', true);
    }

    public function showRegister(): void
    {
        $this->render('auth/register', ['title' => 'Cadastro']);
    }

    public function register(): void
    {
        $this->requirePost();

        if (!Csrf::verify($_POST['_token'] ?? null)) {
            Session::setFlash('error', 'Falha de segurança.');
            $this->redirect('cadastro');
        }

        $name = trim((string) ($_POST['name'] ?? ''));
        $email = trim((string) ($_POST['email'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');
        $confirmation = (string) ($_POST['password_confirmation'] ?? '');

        if ($name === '' || $email === '' || $password === '' || $password !== $confirmation) {
            Session::setFlash('error', 'Preencha todos os campos e confirme a senha corretamente.');
            $this->redirect('cadastro');
        }

        User::create(['name' => $name, 'email' => $email, 'password' => $password]);
        Session::setFlash('success', 'Cadastro concluído. Faça login para continuar.');

        $this->redirect('login');
    }

    public function logout(): void
    {
        $this->requirePost();

        if (!Csrf::verify($_POST['_token'] ?? null)) {
            $this->redirect('/');
        }

        Auth::logout();
        $this->redirect('/');
    }

    private function processLogin(string $redirectTo, bool $adminOnly = false): void
    {
        $this->requirePost();

        if (!Csrf::verify($_POST['_token'] ?? null)) {
            Session::setFlash('error', 'Falha de segurança.');
            $this->redirect($redirectTo);
        }

        $email = trim((string) ($_POST['email'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');

        if ($this->isLockedOut($email)) {
            Session::setFlash('error', 'Muitas tentativas. Aguarde alguns minutos e tente novamente.');
            $this->redirect($redirectTo);
        }

        $user = User::findByEmail($email);

        if (!$user || !password_verify($password, (string) $user['password'])) {
            $this->recordFailedAttempt($email);
            Session::setFlash('error', 'Credenciais inválidas.');
            $this->redirect($redirectTo);
        }

        if ($adminOnly && ($user['role'] ?? 'customer') !== 'admin') {
            Session::setFlash('error', 'Acesso restrito ao painel administrativo.');
            $this->redirect('admin/login');
        }

        $this->clearLoginAttempts($email);
        Auth::login([
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'] ?? 'customer',
        ]);

        $this->redirect($adminOnly ? 'admin' : '/');
    }

    private function recordFailedAttempt(string $email): void
    {
        $attempts = $_SESSION['login_attempts'][$email] ?? ['count' => 0, 'locked_until' => 0];
        $attempts['count']++;

        if ($attempts['count'] >= 5) {
            $attempts['locked_until'] = time() + 900;
        }

        $_SESSION['login_attempts'][$email] = $attempts;
    }

    private function isLockedOut(string $email): bool
    {
        $attempts = $_SESSION['login_attempts'][$email] ?? null;

        return is_array($attempts) && (int) ($attempts['locked_until'] ?? 0) > time();
    }

    private function clearLoginAttempts(string $email): void
    {
        unset($_SESSION['login_attempts'][$email]);
    }
}
