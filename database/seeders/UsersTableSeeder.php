<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Muhammad',
            'last_name' => 'Naeem',
            'email' => 'naeem@gmail.com',
            'gender' => 'Male',
            'password' => bcrypt('Rokhan123'),
        ]);

        $user->assignRole('admin');
    }
}
