<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@xiaomistore.com'],
            [
                'name'     => 'Administrator',
                'email'    => 'admin@xiaomistore.com',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );

        $this->command->info('Admin seeded: admin@xiaomistore.com / password');
    }
}
