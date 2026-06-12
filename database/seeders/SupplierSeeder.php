<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'PT Xiaomi Distribution Indonesia',
                'phone' => '0215550101',
                'email' => 'dist@xiaomi.id',
                'address' => 'Jakarta',
            ],
            [
                'name' => 'PT Mitra Gadget Nusantara',
                'phone' => '0225550202',
                'email' => 'mitra@gadgetnusantara.id',
                'address' => 'Bandung',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::firstOrCreate(['name' => $supplier['name']], $supplier);
        }
    }
}
