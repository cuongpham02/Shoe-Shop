<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert(array(
            0 => array(
                'id' => '1',
                'name' => 'Mens',
                'desc' => 'Men\'s shoes',
                'status' => rand(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ),
            1 => array(
                'id' => '1',
                'name' => 'Womens',
                'desc' => 'women\'s shoes',
                'status' => rand(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ),
            2 => array(
                'id' => '1',
                'name' => 'Kids',
                'desc' => 'Children\'s shoes',
                'status' => rand(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ),
        ));
        Category::factory(30)->create();
    }
}
