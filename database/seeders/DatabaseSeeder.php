<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Payment;
use Illuminate\Database\Seeder;
use Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1,50) as $index) {

            $account = Account::create([
                'name'     =>  $faker->firstName,
                'email'    =>  $faker->email,
                'phone_number'    =>  $faker->phoneNumber
            ]);

            foreach (range(1,50) as $pIndex) {
                Payment::create([
                    'account_id' =>  $account->id,
                    'number'     =>  $faker->randomNumber(5),
                    'amount'     =>  $faker->randomFloat(2,2,500),
                    'status'     =>  $faker->boolean
                ]);

            }
        }

    }
}
