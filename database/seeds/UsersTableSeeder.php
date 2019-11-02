<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = App\User::create([
            'firstName'      => 'Juan',
            'lastName'      => 'Perez',
            'email'     => 'admin@admin.com',
            'password'     => Hash::make('secret'),
            'usuarioCreacion'=>'SYSTEM|::1',
        ]);
    }
}
