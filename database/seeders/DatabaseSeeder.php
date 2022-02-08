<?php

namespace Database\Seeders;

use App\Models\Members;
use App\Models\Outlets;
use App\Models\Packages;
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
        User::create([
            'name' => 'Rana Rosihan',
            'username' => 'sirrana',
            'outlet_id' => 1,
            'roles' => 'OWNER',
            'password' => Hash::make('admin')
        ]);

        Members::factory(100)->create();
        Outlets::factory(100)->create();
        Packages::factory(100)->create();
        User::factory(100)->create();
        Transactions::factory(100)->create();
    }
}
