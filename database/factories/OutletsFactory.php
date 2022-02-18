<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OutletsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'outlet_name' => $this->faker->company,
            'outlet_address' => $this->faker->streetAddress,
            'outlet_phone' => '62' . $this->faker->numerify('##########'),
            'status' => $this->faker->randomElements(['ACTIVE', 'BANKRUPT', 'CLOSED'])[0]
        ];
    }
}
