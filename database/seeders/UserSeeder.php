<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::count() == 0) {
            $admin = new User();
            $admin->name = "Admin";
            $admin->email = "admin@gmail.com";
            $admin->password = Hash::make("12345");
            $admin->is_admin = 1;
            $admin->save();
        }
    }
}
