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

        $outlet_id = $this->faker->randomElement(Outlets::select('id')->get());
        $user_id = $this->faker->randomElement(User::select('id')->get());
        $member_id = $this->faker->randomElement(Members::select('id')->get());

        return [
            'outlet_id' => $outlet_id,
            'user_id' => $user_id,
            'member_id' => $member_id,
            'invoice_code' => strval(now()->day . now()->month . Members::find($member_id)->first()->id . User::find($user_id)->first()->id . Outlets::find($outlet_id)->first()->id . $this->faker->unique()->randomNumber(3, true)),
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
