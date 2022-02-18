<?php

namespace Database\Seeders;

use App\Models\Members;
use App\Models\Outlets;
use App\Models\Packages;
use App\Models\TransactionDetails;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Transaction factory needs some improvement
        // They're buggy and messy, perhaps there are some better ways on approaching this?

        User::create([
            'name' => 'Rana Rosihan',
            'username' => 'sirrana',
            'outlet_id' => 1,
            'roles' => 'OWNER',
            'password' => Hash::make('admin')
        ]);

        User::create([
            'name' => 'Kuro Noelle',
            'username' => 'kuro_100',
            'outlet_id' => 1,
            'roles' => 'ADMIN',
            'password' => Hash::make('admin')
        ]);

        Members::factory(10)->create();
        Outlets::factory(10)->create();
        Packages::factory(10)->create();
        User::factory(10)->create();
        // Transactions::factory(10)->create();
        // TransactionDetails::factory(10)->create();
    }
}
