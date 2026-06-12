<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $defaultSupplierId = Supplier::query()->value('id');

        $products = [
            [
                'name'        => 'Xiaomi 14',
                'price'       => 13999000,
                'description' => 'Xiaomi 14 hadir dengan prosesor Snapdragon 8 Gen 3, kamera Leica 50MP, layar AMOLED 6.36" 120Hz, dan baterai 4610mAh dengan fast charging 90W.',
                'category'    => 'Smartphone',
                'image'       => null,
            ],
            [
                'name'        => 'Xiaomi 13T Pro',
                'price'       => 11999000,
                'description' => 'Xiaomi 13T Pro ditenagai Dimensity 9200+, kamera Leica 50MP, layar AMOLED 6.67" 144Hz, baterai 5000mAh dengan charging 120W.',
                'category'    => 'Smartphone',
                'image'       => null,
            ],
            [
                'name'        => 'Redmi Note 13 Pro+',
                'price'       => 5499000,
                'description' => 'Redmi Note 13 Pro+ mengusung kamera 200MP, layar AMOLED 6.67" 120Hz, baterai 5000mAh, dan fast charging 120W.',
                'category'    => 'Smartphone',
                'image'       => null,
            ],
            [
                'name'        => 'Xiaomi Pad 6',
                'price'       => 4999000,
                'description' => 'Tablet premium dengan layar IPS 11" 144Hz, prosesor Snapdragon 870, RAM 8GB, storage 256GB.',
                'category'    => 'Tablet',
                'image'       => null,
            ],
            [
                'name'        => 'Mi Watch S3',
                'price'       => 2199000,
                'description' => 'Smartwatch dengan layar AMOLED 1.43", GPS, sensor detak jantung, SpO2, tahan air 5ATM, baterai 14 hari.',
                'category'    => 'Wearable',
                'image'       => null,
            ],
            [
                'name'        => 'Redmi Buds 5 Pro',
                'price'       => 799000,
                'description' => 'TWS earbuds dengan ANC aktif, driver 11mm, latensi rendah 55ms, IPX4, dan ketahanan baterai total 38 jam.',
                'category'    => 'Audio',
                'image'       => null,
            ],
        ];

        foreach ($products as $product) {
            $category = Category::where('name', $product['category'])->first();
            $product['category_id'] = $category?->id;
            $product['supplier_id'] = $defaultSupplierId;
            Product::create($product);
        }

        $this->command->info('6 products seeded successfully.');
    }
}
