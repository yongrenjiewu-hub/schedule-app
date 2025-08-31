<?php

namespace Database\Seeders;

use App\Models\TMeal;
use Illuminate\Database\Seeder;

class TMealSeeder extends Seeder
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
            TMeal::insert([
                't_meal_id' => $i,
                'pt_id' => $i,
                'meal_id' => $i,
                'daily_schedule_date' => today(),
                'pt_schedule_id' => $i,
            ]);
        }

        for ($i = 1; $i < 10; $i++) {
            TMeal::insert([
                't_meal_id' => $i + 10,
                'pt_id' => $i,
                'meal_id' => $i,
                'daily_schedule_date' => today(),
                'pt_schedule_id' => $i,
            ]);
        }

        for ($i = 1; $i < 10; $i++) {
            TMeal::insert([
                't_meal_id' => $i + 20,
                'pt_id' => $i,
                'meal_id' => $i,
                'daily_schedule_date' => today(),
                'pt_schedule_id' => $i,
            ]);
        }
    }
}
