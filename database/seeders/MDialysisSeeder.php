<?php

namespace Database\Seeders;

use App\Models\Mdialysis;
use Illuminate\Database\Seeder;

class MDialysisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        MDialysis::insert([
            ['dialysis_id' => '1', 'part' => '右上肢', 'dialysis_day' => '月曜日', 'dialysis_date' => '10:00'],
            ['dialysis_id' => '2', 'part' => '右上肢', 'dialysis_day' => '火曜日', 'dialysis_date' => '10:00'],
            ['dialysis_id' => '3', 'part' => '右上肢', 'dialysis_day' => '水曜日', 'dialysis_date' => '10:00'],
            ['dialysis_id' => '4', 'part' => '右上肢', 'dialysis_day' => '木曜日', 'dialysis_date' => '10:00'],
            ['dialysis_id' => '5', 'part' => '右上肢', 'dialysis_day' => '金曜日', 'dialysis_date' => '10:00'],
            ['dialysis_id' => '6', 'part' => '右上肢', 'dialysis_day' => '土曜日', 'dialysis_date' => '10:00'],
            ['dialysis_id' => '7', 'part' => '左上肢', 'dialysis_day' => '月曜日', 'dialysis_date' => '10:00'],
            ['dialysis_id' => '8', 'part' => '左上肢', 'dialysis_day' => '火曜日', 'dialysis_date' => '10:00'],
            ['dialysis_id' => '9', 'part' => '左上肢', 'dialysis_day' => '水曜日', 'dialysis_date' => '10:00'],
            ['dialysis_id' => '10', 'part' => '左上肢', 'dialysis_day' => '木曜日', 'dialysis_date' => '10:00'],
            ['dialysis_id' => '11', 'part' => '左上肢', 'dialysis_day' => '金曜日', 'dialysis_date' => '10:00'],
            ['dialysis_id' => '12', 'part' => '左上肢', 'dialysis_day' => '土曜日', 'dialysis_date' => '10:00'],
        ]);
    }
}
