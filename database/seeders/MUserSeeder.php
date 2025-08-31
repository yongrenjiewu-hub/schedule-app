<?php

namespace Database\Seeders;

use App\Models\MUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 1; $i < 10; $i++) {
            MUser::insert([
                'user_id' => $i,
                'ns_name' => 'test' . $i . 'Ns',
                'password' => Hash::make('password'),
                'email' => 'test' . $i . '@example.com',
            ]);
        }
    }
}
