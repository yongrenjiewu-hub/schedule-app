<?php

namespace Database\Seeders;

use App\Models\TTreatmentkind;
use Illuminate\Database\Seeder;

class TTreatmentkindSeeder extends Seeder
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
            TTreatmentkind::insert([
                't_treatment_kind_id' => $i,
                'pt_id' => $i,
                'treatment_kind_id' => $i,
                'daily_schedule_date' => today(),
                'pt_schedule_id' => $i,
            ]);
        }
    }
}
