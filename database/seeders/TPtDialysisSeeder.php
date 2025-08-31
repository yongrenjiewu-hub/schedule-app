<?php

namespace Database\Seeders;

use App\Models\TPtDialysis;
use Illuminate\Database\Seeder;

class TPtDialysisSeeder extends Seeder
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
            TPtDialysis::insert([
                'pt_dialysis_id' => $i,
                'pt_id' => $i,
                'daily_schedule_date' => today(),
            ]);
        }
    }
}
