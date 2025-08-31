<?php

namespace Database\Seeders;

use App\Models\TMedicalrecord;
use Illuminate\Database\Seeder;

class TMedicalrecordSeeder extends Seeder
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
            TMedicalrecord::insert([
                'record_id' => $i,
                'pt_id' => $i,
                'pt_record' => '',
            ]);
        }
    }
}
