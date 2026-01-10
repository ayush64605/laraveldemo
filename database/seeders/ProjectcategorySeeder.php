<?php

namespace Database\Seeders;

use App\Models\Projectcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Projectcategory::count() == 0) {
            $productcategory = new Projectcategory();
            $productcategory->name = "Web Design";
            $productcategory->save();
        }
    }
}
