<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::where('name', 'role_admin')->first();
        
        $usuario = Role::where('name', 'role_user')->first();

        $administrador = User::create([
            'name' => 'Administrador',
            'email' => 'administrador@aluno.unifapce.edu.br',
            'password' => '12345678',
        ]);
        
        $user = User::create([
            'name' => 'Usuário',
            'email' => 'usuario@aluno.unifapce.edu.br',
            'password' => '12345678',
        ]);

        $administrador->roles()->attach($admin);
        
        $user->roles()->attach($usuario);
    }
}