<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MembersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'member_name' => $this->faker->name,
            'member_address' => $this->faker->address,
            'member_phone' => $this->faker->e164PhoneNumber,
            'member_gender' => $this->faker->randomElements(['MALE', 'FEMALE'])[0]
        ];
    }
}
