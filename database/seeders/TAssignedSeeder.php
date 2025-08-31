<?php

namespace Database\Seeders;

use App\Models\TAssigned;
use Illuminate\Database\Seeder;

class TAssignedSeeder extends Seeder
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
            TAssigned::insert([
                'assigned_id' => $i,
                'pt_id' => $i,
                'user_id' => $i,
                'assigned_date' => now()
            ]);
        }
    }
}

