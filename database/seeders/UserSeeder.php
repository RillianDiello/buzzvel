<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
          'name' => 'Rillian',
          'email' => 'rillian@email.com',
          'password' => 'rillian123'
        ]);
        User::create(['name' => 'Diello', 'email' => 'diello@email.com', 'password' => 'diello123']);
        User::create(['name' => 'Lucas', 'email' => 'lucas@email.com', 'password' => 'lucas123']);
        User::create(['name' => 'Pires', 'email' => 'pires@email.com', 'password' => 'pires123']);
    }
}
