<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Ejecutar el seeder.
     */
    public function run(): void
    {
        // 🟥 Usuario Administrador
        User::updateOrCreate(
            ['email' => 'admin@crm.com'],
            [
                'name' => 'Administrador General',
                'password' => Hash::make('Admin123'),
                'role' => 'admin',
                'status' => true,
            ]
        );

        // 🟨 Usuario Gerente
        User::updateOrCreate(
            ['email' => 'manager@crm.com'],
            [
                'name' => 'Gerente de Ventas',
                'password' => Hash::make('Manager123'),
                'role' => 'manager',
                'status' => true,
            ]
        );

        // 🟩 Usuario Vendedor
        User::updateOrCreate(
            ['email' => 'vendedor@crm.com'],
            [
                'name' => 'Vendedor Principal',
                'password' => Hash::make('Seller123'),
                'role' => 'seller',
                'status' => true,
            ]
        );
    }
}
