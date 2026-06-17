<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mercadinho Juvenil - Lanches, Combos e Bebidas">
    <meta name="theme-color" content="#DC143C">

    <title>@yield('title', 'Mercadinho Juvenil - Lanches & Bebidas')</title>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @stack('styles')
</head>
<body>
    <!-- Header/Nav -->
    <header class="header">
        <div class="header-top">
            <div class="container">
                <div class="header-content">
                    <a href="/" class="logo">
                        <span class="logo-text">🍔 Mercadinho<br><span class="logo-juvenil">Juvenil</span></span>
                    </a>

                    <button class="mobile-menu-toggle" id="mobileMenuToggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                    <nav class="nav-desktop">
                        <a href="/" class="nav-link">Home</a>
                        <a href="#cardapio" class="nav-link">Cardápio</a>
                        <a href="#" class="nav-link">Sobre</a>
                        <a href="#" class="nav-link">Contato</a>
                    </nav>

                    <div class="header-actions">
                        <a href="/cart" class="cart-link">
                            <span class="cart-icon">🛒</span>
                            <span class="cart-badge" id="cartBadge">0</span>
                        </a>
                        @auth
                            <a href="/profile" class="account-link">👤</a>
                        @else
                            <a href="/login" class="btn-small btn-outline">Entrar</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <nav class="nav-mobile" id="mobileMenu">
            <a href="/" class="nav-link-mobile">Home</a>
            <a href="#cardapio" class="nav-link-mobile">Cardápio</a>
            <a href="#" class="nav-link-mobile">Sobre</a>
            <a href="#" class="nav-link-mobile">Contato</a>
            @guest
                <a href="/login" class="nav-link-mobile btn-primary">Entrar</a>
            @endguest
        </nav>
    </header>

    <!-- Main Content -->
    <main class="main">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>Mercadinho Juvenil</h4>
                    <p>Lanches, Combos e Bebidas deliciosas</p>
                </div>

                <div class="footer-section">
                    <h4>Links Rápidos</h4>
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="#cardapio">Cardápio</a></li>
                        <li><a href="#">Sobre</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Contato</h4>
                    <p>📞 (11) 96021-7697</p>
                    <p>📧 contato@juvenil.com</p>
                    <p>⏰ Seg-Dom: 11:00 - 23:00</p>
                </div>

                <div class="footer-section">
                    <h4>Redes Sociais</h4>
                    <div class="social-links">
                        <a href="#" class="social-link">Instagram</a>
                        <a href="#" class="social-link">WhatsApp</a>
                        <a href="#" class="social-link">Facebook</a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2026 Mercadinho Juvenil. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>
