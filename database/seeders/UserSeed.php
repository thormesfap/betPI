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
        $thormes = User::create([
            'name' => 'Thormes Filgueira Leite Pereira',
            'email' => 'thormes@aluno.unifapce.edu.br',
            'password' => '12345678',
        ]);
        $thormes->roles()->attach($admin);
    }
}
