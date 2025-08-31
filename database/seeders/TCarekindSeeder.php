<?php

namespace Database\Seeders;

use App\Models\TCarekind;
use Illuminate\Database\Seeder;

class TCarekindSeeder extends Seeder
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
            TCarekind::insert([
                't_care_kind_id' => $i,
                'pt_id' => $i,
                'care_kind_id' => $i,
                'daily_schedule_date' => today(),
                'pt_schedule_id' => $i,
            ]);
        }
    }
}
