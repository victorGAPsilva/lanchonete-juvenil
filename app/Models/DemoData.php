<?php
declare(strict_types=1);

namespace App\Models;

final class DemoData
{
    public static function categories(): array
    {
        return [
            ['id' => 1, 'name' => 'Lanches', 'slug' => 'lanches', 'icon' => 'burger'],
            ['id' => 2, 'name' => 'Bebidas', 'slug' => 'bebidas', 'icon' => 'drink'],
            ['id' => 3, 'name' => 'Porções', 'slug' => 'porcoes', 'icon' => 'fries'],
            ['id' => 4, 'name' => 'Sobremesas', 'slug' => 'sobremesas', 'icon' => 'dessert'],
        ];
    }

    public static function products(): array
    {
        return [
            ['id' => 1, 'category_id' => 1, 'name' => 'X Juvenil Clássico', 'slug' => 'x-juvenil-classico', 'description' => 'Hambúrguer suculento, queijo, alface crocante e molho da casa.', 'price' => 24.90, 'featured' => 1, 'promo' => 0, 'fresh' => 1, 'available' => 1, 'image' => null],
            ['id' => 2, 'category_id' => 1, 'name' => 'X-Tudo Premium', 'slug' => 'x-tudo-premium', 'description' => 'Uma explosão de sabor com bacon, ovo, cheddar e cebola caramelizada.', 'price' => 31.90, 'featured' => 1, 'promo' => 1, 'fresh' => 0, 'available' => 1, 'image' => null],
            ['id' => 3, 'category_id' => 1, 'name' => 'Hot Dog da Casa', 'slug' => 'hot-dog-da-casa', 'description' => 'Salsicha, purê, batata palha e molho encorpado.', 'price' => 19.90, 'featured' => 0, 'promo' => 1, 'fresh' => 0, 'available' => 1, 'image' => null],
            ['id' => 4, 'category_id' => 3, 'name' => 'Batata Crocante', 'slug' => 'batata-crocante', 'description' => 'Porção grande, dourada e perfeita para compartilhar.', 'price' => 18.50, 'featured' => 1, 'promo' => 0, 'fresh' => 1, 'available' => 1, 'image' => null],
            ['id' => 5, 'category_id' => 2, 'name' => 'Refrigerante Lata', 'slug' => 'refrigerante-lata', 'description' => 'Geladinho para acompanhar qualquer pedido.', 'price' => 6.00, 'featured' => 0, 'promo' => 0, 'fresh' => 0, 'available' => 1, 'image' => null],
            ['id' => 6, 'category_id' => 2, 'name' => 'Milkshake Especial', 'slug' => 'milkshake-especial', 'description' => 'Creme gelado com cobertura generosa e muito sabor.', 'price' => 15.90, 'featured' => 1, 'promo' => 0, 'fresh' => 1, 'available' => 1, 'image' => null],
            ['id' => 7, 'category_id' => 4, 'name' => 'Sundae Caramelo', 'slug' => 'sundae-caramelo', 'description' => 'Sobremesa cremosa com cobertura de caramelo e farofa doce.', 'price' => 13.90, 'featured' => 0, 'promo' => 1, 'fresh' => 0, 'available' => 1, 'image' => null],
            ['id' => 8, 'category_id' => 3, 'name' => 'Onion Rings', 'slug' => 'onion-rings', 'description' => 'Anéis de cebola crocantes com tempero especial.', 'price' => 16.90, 'featured' => 0, 'promo' => 0, 'fresh' => 0, 'available' => 1, 'image' => null],
        ];
    }

    public static function users(): array
    {
        return [
            ['id' => 1, 'name' => 'Administrador', 'email' => 'admin@juvenil.com', 'password' => '$2y$10$E7qkq2mnpbpLsCgq5SHJZ.LvmNYumrKMwm/dkNoBqo4b2EOXesWQ6', 'role' => 'admin'],
            ['id' => 2, 'name' => 'Cliente Demo', 'email' => 'cliente@juvenil.com', 'password' => '$2y$10$E7qkq2mnpbpLsCgq5SHJZ.LvmNYumrKMwm/dkNoBqo4b2EOXesWQ6', 'role' => 'customer'],
        ];
    }

    public static function settings(): array
    {
        return [
            'opening_hours' => 'Segunda a domingo, 17h às 23h',
            'delivery_fee' => 5.90,
            'delivery_area' => 'Centro, Vila Nova e região próxima',
            'phone' => '(11) 99999-9999',
            'whatsapp' => '5511999999999',
            'address' => 'Rua da Juventude, 123 - São Paulo/SP',
        ];
    }

    public static function orders(): array
    {
        return [
            ['id' => 1, 'code' => 'JU-1024', 'customer_name' => 'Marina Silva', 'status' => 'received', 'payment_method' => 'Pix', 'delivery_type' => 'delivery', 'total' => 49.80, 'created_at' => '2026-06-30 19:24:00'],
            ['id' => 2, 'code' => 'JU-1025', 'customer_name' => 'Carlos Souza', 'status' => 'preparing', 'payment_method' => 'Cartão', 'delivery_type' => 'pickup', 'total' => 31.90, 'created_at' => '2026-07-01 11:10:00'],
            ['id' => 3, 'code' => 'JU-1026', 'customer_name' => 'Ana Costa', 'status' => 'ready', 'payment_method' => 'Dinheiro', 'delivery_type' => 'pickup', 'total' => 28.80, 'created_at' => '2026-07-01 12:05:00'],
        ];
    }
}
