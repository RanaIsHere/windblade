<?php

namespace Database\Factories;

use App\Models\Packages;
use App\Models\Transactions;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $transaction_id = $this->faker->randomElement(Transactions::select('id')->get());
        $package_id = $this->faker->randomElement(Packages::select('id')->get());

        return [
            'transaction_id' => Transactions::find($transaction_id)->first()->id,
            'package_id' => $package_id,
            'quantity' => $this->faker->numberBetween(1, 50),
            'notes' => $this->faker->randomElements(['NONE', strval($this->faker->paragraph())])[0]
        ];
    }
}
