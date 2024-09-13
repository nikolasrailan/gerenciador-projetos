<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Dados para o admin
        $data_admin = [
            "name" => "admin",
            "email" => "admin@gmail.com",
            "password" => Hash::make('admin123'),
        ];
        
        // Criação do usuário admin
        $admin = User::create($data_admin);
        $admin->assignRole('admin');

        // Dados para o cliente
        $data_cliente = [
            "name" => "cliente",
            "email" => "cliente@gmail.com",
            "password" => Hash::make('cliente123'),
        ];
        
        // Criação do usuário cliente
        $cliente = User::create($data_cliente);
        $cliente->assignRole('cliente');
    }
}
