<?php
declare(strict_types=1);

use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\OrderController;
use App\Controllers\Admin\ProductController;
use App\Controllers\Admin\SettingsController;
use App\Controllers\AuthController;
use App\Controllers\CartController;
use App\Controllers\CheckoutController;
use App\Controllers\HomeController;
use App\Controllers\MenuController;
use App\Controllers\ProductController as ProductPageController;
use App\Controllers\TrackController;
use App\Core\Router;

return static function (Router $router): void {
    $router->get('/', [HomeController::class, 'index']);
    $router->get('/cardapio', [MenuController::class, 'index']);
    $router->get('/produto', [ProductPageController::class, 'show']);
    $router->get('/carrinho', [CartController::class, 'index']);
    $router->get('/checkout', [CheckoutController::class, 'index']);
    $router->post('/checkout', [CheckoutController::class, 'store']);
    $router->get('/acompanhar-pedido', [TrackController::class, 'show']);

    $router->get('/login', [AuthController::class, 'showLogin']);
    $router->post('/login', [AuthController::class, 'login']);
    $router->get('/cadastro', [AuthController::class, 'showRegister']);
    $router->post('/cadastro', [AuthController::class, 'register']);
    $router->post('/logout', [AuthController::class, 'logout']);

    $router->post('/cart/add', [CartController::class, 'add']);
    $router->post('/cart/update', [CartController::class, 'update']);
    $router->post('/cart/remove', [CartController::class, 'remove']);
    $router->post('/cart/clear', [CartController::class, 'clear']);

    $router->get('/admin', [DashboardController::class, 'index']);
    $router->get('/admin/login', [AuthController::class, 'showAdminLogin']);
    $router->post('/admin/login', [AuthController::class, 'adminLogin']);
    $router->get('/admin/produtos', [ProductController::class, 'index']);
    $router->post('/admin/produtos', [ProductController::class, 'store']);
    $router->post('/admin/produtos/excluir', [ProductController::class, 'delete']);
    $router->get('/admin/pedidos', [OrderController::class, 'index']);
    $router->post('/admin/pedidos/status', [OrderController::class, 'updateStatus']);
    $router->get('/admin/configuracoes', [SettingsController::class, 'index']);
    $router->post('/admin/configuracoes', [SettingsController::class, 'store']);
};
