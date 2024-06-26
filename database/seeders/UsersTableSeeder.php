<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'name' => 'Imad Khair',
            'email' => 'imad@beitsahour.ps',
            'password' => Hash::make('BeitSmuni@!2022@!'),
            'role' => 'admin', // Assign admin role
        ]);
    }
}
