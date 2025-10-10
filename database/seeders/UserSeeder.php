<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@crm.com'],
            ['name' => 'Administrador', 'password' => Hash::make('Admin123'), 'role' => 'admin']
        );

        User::updateOrCreate(
            ['email' => 'manager@crm.com'],
            ['name' => 'Gerente', 'password' => Hash::make('Manager123'), 'role' => 'manager']
        );

        User::updateOrCreate(
            ['email' => 'vendedor@crm.com'],
            ['name' => 'Vendedor', 'password' => Hash::make('Seller123'), 'role' => 'seller']
        );
    }
}
