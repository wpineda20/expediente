<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::findOrFail(1);
        $roleUsuario = Role::findOrFail(2);
        $roleEditor = Role::findOrFail(3);

        $user = User::create([
            'id' => 1,
            'name' => 'Administrador',
            'last_name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);
        $user->assignRole($roleAdmin);
    }
}
