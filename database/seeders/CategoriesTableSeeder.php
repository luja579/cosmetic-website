<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            ['category_name' => 'Eye'],
            ['category_name' => 'Lips'],
            ['category_name' => ' Skin'],
            ['category_name' => ' Nails'],
        ]);
    }
}
