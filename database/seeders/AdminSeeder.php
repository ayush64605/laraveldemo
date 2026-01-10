<?php

namespace Database\Seeders;

use App\Models\Admin;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Admin::count() == 0) {
            $admin = new Admin();
            $admin->name = "Admin";
            $admin->email = "admin@gmail.com";
            $admin->password = Hash::make("12345");
            $admin->save();
        }
    }
}
