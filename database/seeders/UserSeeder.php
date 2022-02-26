<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password')
        ]);

        $operations = User::create([
            'name' => 'Operador',
            'email' => 'op@mail.com',
            'password' => Hash::make('password')
        ]);

        $admin->assignRole('admin');
    }
}
