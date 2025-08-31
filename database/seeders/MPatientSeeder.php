<?php

namespace Database\Seeders;

use App\Models\MPatient;
use Illuminate\Database\Seeder;

class MPatientSeeder extends Seeder
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
            MPatient::insert([
                'pt_id' => $i,
                'room_id' => $i,
                'pt_name' => 'テスト' . $i,
                'sex' => '男',
                'blood_type' => 'A',
                'birthday' => '1987-01-01',
                'disease_id' => $i,
                'tell_number' => $i,
                'key_person' => 'haha',
                'Dr_name' => $i . '先生',
            ]);
        }
    }
}
