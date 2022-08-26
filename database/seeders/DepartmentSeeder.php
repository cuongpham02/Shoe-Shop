<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::insert(array(
            0 => array(
                'id' => '1',
                'name' => 'PHP',
                'desc' => 'Programming language PHP',
                'status' => rand(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ),
            1 => array(
                'id' => '1',
                'name' => 'Ruby',
                'desc' => 'Programming language Ruby',
                'status' => rand(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ),
            2 => array(
                'id' => '1',
                'name' => 'Html & Css',
                'desc' => 'Html & Css',
                'status' => rand(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ),
            3 => array(
                'id' => '1',
                'name' => 'Javascript',
                'desc' => 'Programming language Javascript',
                'status' => rand(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ),
            4 => array(
                'id' => '1',
                'name' => 'Mysql',
                'desc' => 'Database Mysql',
                'status' => rand(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ),
        ));
        Department::factory(30)->create();
    }
}
