<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;

// use Database\Seeders\RolesAndPermissionsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TablesSeeder::class);
    }
}
