<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'desc' =>$this->faker->name(),
            'status' => rand(0,1),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
