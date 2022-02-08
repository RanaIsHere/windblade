<?php

namespace Database\Factories;

use App\Models\Members;
use App\Models\Outlets;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // suffering
        // todo: this thing

        return [
            'outlet_id' => $this->faker->randomElement(User::select('outlet_id')->get()),
            'user_id' => $this->faker->randomElement(User::select('outlet_id')->get()),
            'member_id' => $this->faker->randomElement(Members::select('id')->get()),
            'invoice_code' => now()->day . now()->month . $this->faker->randomElement(Members::select('id')->get()) . $this->faker->randomElement(User::select('id')->get()) . $this->faker->randomElement(User::select('outlet_id')->get()) . $this->faker->unique()->randomNumber(3, true),
            'transaction_date' => now(),
            'transaction_deadline' => now(),
            'transaction_paydate' => now(),
            'transaction_paid' => $this->faker->numberBetween(5000, 150000),
            'transaction_paid_extra' => $this->faker->numberBetween(5000, 10000),
            'transaction_discount' => $this->faker->randomElements([0, 10, 20, 30])[0],
            'transaction_tax' => $this->faker->numberBetween(5000, 150000) * (2 / 100),
            'status' => $this->faker->randomElements(['NEW', 'PROCESSING', 'FINISHED', 'PULLED'])[0],
            'paid_status' => $this->faker->randomElements(['PAID', 'UNPAID'])[0]
        ];
    }
}
