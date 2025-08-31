<?php

namespace Database\Seeders;

use App\Models\MDisease;
use Illuminate\Database\Seeder;

class MDiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        MDisease::insert([
            ['disease_id' => '1', 'disease_name' => '急性心筋梗塞'],
            ['disease_id' => '2', 'disease_name' => '急性大動脈解離'],
            ['disease_id' => '3', 'disease_name' => '硬膜外血腫'],
            ['disease_id' => '4', 'disease_name' => '硬膜下出血'],
            ['disease_id' => '5', 'disease_name' => 'くも膜下出血'],
            ['disease_id' => '6', 'disease_name' => '脳梗塞'],
            ['disease_id' => '7', 'disease_name' => '脳出血'],
            ['disease_id' => '8', 'disease_name' => 'イレウス'],
            ['disease_id' => '9', 'disease_name' => '急性汎発性腹膜炎'],
            ['disease_id' => '10', 'disease_name' => 'てんかん発作'],
            ['disease_id' => '11', 'disease_name' => '頭部外傷'],
            ['disease_id' => '12', 'disease_name' => '一酸化炭素中毒'],
            ['disease_id' => '13', 'disease_name' => '薬物中毒'],
            ['disease_id' => '14', 'disease_name' => '糖尿病性低血糖発作'],
            ['disease_id' => '15', 'disease_name' => '脳腫瘍'],
        ]);

    }
}
