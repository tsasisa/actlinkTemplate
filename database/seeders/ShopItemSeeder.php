<?php

namespace Database\Seeders;

use App\Models\ShopItem;
use Illuminate\Database\Seeder;

class ShopItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'Volunteer T-Shirt',
                'description' => 'A cool Actlink-branded volunteer t-shirt.',
                'price' => 500,
                'quantity' => 20,
                'image' => 'assets/images/shop/volunteer-tshirt.png',
            ],
            [
                'name' => 'Eco-friendly Water Bottle',
                'description' => 'A reusable water bottle for your volunteer journey.',
                'price' => 300,
                'quantity' => 30,
                'image' => 'assets/images/shop/eco-bottle.png',
            ],
            [
                'name' => 'Sticker Pack',
                'description' => 'Sticker pack for upcoming volunteer events.',
                'price' => 100,
                'quantity' => 10,
                'image' => 'assets/images/shop/sticker-pack.png',
            ],
        ];

        foreach ($items as $item) {
            ShopItem::create($item);
        }
    }
}
