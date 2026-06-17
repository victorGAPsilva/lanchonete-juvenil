@extends('layouts.app')

@section('title', 'Mercadinho Juvenil - Peça Agora')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Fome de verdade?</h1>
                <p>Lanches frescos, saborosos e entregues rápido!</p>
                <a href="#cardapio" class="btn btn-primary btn-lg">PEÇA AGORA</a>
            </div>
            <div class="hero-image">
                <span class="hero-emoji">🍔🍟🌮</span>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories-section">
        <div class="container">
            <h2>Nossas Categorias</h2>
            <div class="categories-grid">
                <div class="category-card">
                    <div class="category-icon">🍔</div>
                    <h3>Hambúrgueres</h3>
                    <p>Suculentos e frescos</p>
                </div>
                <div class="category-card">
                    <div class="category-icon">🌯</div>
                    <h3>Combos</h3>
                    <p>Melhores promoções</p>
                </div>
                <div class="category-card">
                    <div class="category-icon">🍟</div>
                    <h3>Batatas</h3>
                    <p>Crocantes e douradas</p>
                </div>
                <div class="category-card">
                    <div class="category-icon">🥤</div>
                    <h3>Bebidas</h3>
                    <p>Geladas e refrescantes</p>
                </div>
                <div class="category-card">
                    <div class="category-icon">🍰</div>
                    <h3>Sobremesas</h3>
                    <p>Doces irresistíveis</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="featured-section" id="cardapio">
        <div class="container">
            <h2>Mais Vendidos</h2>
            <div class="products-grid" id="featuredProducts">
                <!-- Skeleton loading -->
                <div class="product-card skeleton"></div>
                <div class="product-card skeleton"></div>
                <div class="product-card skeleton"></div>
                <div class="product-card skeleton"></div>
            </div>
        </div>
    </section>

    <!-- Combos Promo Section -->
    <section class="combos-section">
        <div class="container">
            <div class="combos-header">
                <h2>Combos Imperdíveis ⚡</h2>
                <p class="promo-badge">OFERTA LIMITADA</p>
            </div>
            <div class="combos-grid" id="combosGrid">
                <!-- Loaded via JS -->
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section class="reviews-section">
        <div class="container">
            <h2>O que nossos clientes dizem</h2>
            <div class="reviews-grid">
                <div class="review-card">
                    <div class="review-rating">⭐⭐⭐⭐⭐</div>
                    <p>"Melhor lanchonete da região! Rápido e delicioso!"</p>
                    <p class="review-author">— João Silva</p>
                </div>
                <div class="review-card">
                    <div class="review-rating">⭐⭐⭐⭐⭐</div>
                    <p>"Adorei! Comida fresca e bem embalada. Recomendo!"</p>
                    <p class="review-author">— Maria Santos</p>
                </div>
                <div class="review-card">
                    <div class="review-rating">⭐⭐⭐⭐⭐</div>
                    <p>"Entrega super rápida. Qualidade impecável sempre!"</p>
                    <p class="review-author">— Carlos Mendes</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Final -->
    <section class="cta-final">
        <div class="container">
            <h2>Pronto para pedir?</h2>
            <p>Não perca tempo! Peça agora e aproveite nossas promoções</p>
            <a href="#cardapio" class="btn btn-primary btn-lg">COMEÇAR PEDIDO</a>
        </div>
    </section>

    @push('scripts')
        <script src="{{ asset('js/products.js') }}"></script>
        <script src="{{ asset('js/cart.js') }}"></script>
    @endpush
@endsection
