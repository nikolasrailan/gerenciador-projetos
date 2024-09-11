<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpar o cache de permissões
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Criar permissões relacionadas a Projetos
        Permission::create(['name' => 'view projects']);
        Permission::create(['name' => 'create projects']);
        Permission::create(['name' => 'edit projects']);
        Permission::create(['name' => 'delete projects']);

        // Criar permissões relacionadas a Tarefas
        Permission::create(['name' => 'view tasks']);
        Permission::create(['name' => 'create tasks']);
        Permission::create(['name' => 'edit tasks']);
        Permission::create(['name' => 'delete tasks']);
        Permission::create(['name' => 'change task status']);

        // Criar permissões relacionadas a Usuários
        Permission::create(['name' => 'manage users']);

        // Criar papéis e atribuir permissões

        // Papel admin
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'view projects',
            'create projects',
            'edit projects',
            'delete projects',
            'view tasks',
            'create tasks',
            'edit tasks',
            'delete tasks',
            'change task status',
            'manage users'
        ]);

        // Papel cliente
        $clientRole = Role::create(['name' => 'cliente']);
        $clientRole->givePermissionTo([
            'view projects',
            'view tasks'
        ]);

        // Papel super-admin com todas as permissões
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo(Permission::all());

        // Atribuir o papel de admin ao primeiro usuário (opcional)
        $adminUser = \App\Models\User::find(1);
        if ($adminUser) {
            $adminUser->assignRole('admin');
        }
    }
}
