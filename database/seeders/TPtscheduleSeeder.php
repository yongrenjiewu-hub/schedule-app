<?php

namespace Database\Seeders;

use App\Models\TPtschedule;
use Illuminate\Database\Seeder;

class TPtscheduleSeeder extends Seeder
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
            TPtschedule::insert([
                'pt_schedule_id' => $i,
                'pt_id' => $i,
                'meal_id' => $i,
                'care_kind_id' => $i,
                'treatment_kind_id' => $i,
                'medicine_id' => $i,
                'daily_schedule_date' => today(),
            ]);
        }
    }
}
