<?php

namespace Database\Seeders;

use App\Models\MCarekind;
use Illuminate\Database\Seeder;

class MCarekindSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        MCarekind::insert([
            //スケジュールをtimeでソート　終日の対応の場合時間を23:59にしている
            ['care_kind_id' => '1', 'category' => 'Bed_bath', 'key' => 'bathing', 'value' => '入浴', 'Fcare_date' => '15:00', 'Scare_date' => NULL, 'Tcare_date' => NULL],
            ['care_kind_id' => '2', 'category' => 'Bed_bath', 'key' => 'shawer', 'value' => 'シャワー浴', 'Fcare_date' => '15:00', 'Scare_date' => NULL, 'Tcare_date' => NULL],
            ['care_kind_id' => '3', 'category' => 'Bed_bath', 'key' => 'wiping_all', 'value' => '清拭（全介助', 'Fcare_date' => '10:00', 'Scare_date' => '15:00', 'Tcare_date' => NULL],
            ['care_kind_id' => '4', 'category' => 'Bed_bath', 'key' => 'wiping_portion', 'value' => '清拭（一部介助', 'Fcare_date' => '10:00', 'Scare_date' => NULL, 'Tcare_date' => NULL],
            ['care_kind_id' => '5', 'category' => 'Bed_bath', 'key' => 'changing_diapers', 'value' => 'おむつ交換', 'Fcare_date' => '9:00', 'Scare_date' => '15:00', 'Tcare_date' => '20:00'],
            ['care_kind_id' => '6', 'category' => 'drink', 'key' => 'free', 'value' => 'free', 'Fcare_date' => '23:59', 'Scare_date' => NULL, 'Tcare_date' => NULL],
            ['care_kind_id' => '7', 'category' => 'drink', 'key' => 'thichness', 'value' => 'とろみ', 'Fcare_date' => '23:59', 'Scare_date' => NULL, 'Tcare_date' => NULL],
            ['care_kind_id' => '8', 'category' => 'drink', 'key' => 'middle_thichness', 'value' => '中間とろみ', 'Fcare_date' => '23:59', 'Scare_date' => NULL, 'Tcare_date' => NULL],
            ['care_kind_id' => '9', 'category' => 'drink', 'key' => 'limited', 'value' => '制限あり', 'Fcare_date' => '23:59', 'Scare_date' => NULL, 'Tcare_date' => NULL],
            ['care_kind_id' => '10', 'category' => 'care_level', 'key' => 'full_assistance', 'value' => '全介助', 'Fcare_date' => '23:59', 'Scare_date' => NULL, 'Tcare_date' => NULL],
            ['care_kind_id' => '11', 'category' => 'care_level', 'key' => 'patial_asistance', 'value' => '一部介助', 'Fcare_date' => '23:59', 'Scare_date' => NULL, 'Tcare_date' => NULL],
            ['care_kind_id' => '12', 'category' => 'care_level', 'key' => 'free', 'value' => 'free', 'Fcare_date' => '23:59', 'Scare_date' => NULL, 'Tcare_date' => NULL],
            ['care_kind_id' => '13', 'category' => 'rest_grade', 'key' => 'word_free', 'value' => '病棟内free', 'Fcare_date' => '23:59', 'Scare_date' => NULL, 'Tcare_date' => NULL],
            ['care_kind_id' => '14', 'category' => 'rest_grade', 'key' => 'bed_rest', 'value' => '床上安静', 'Fcare_date' => '23:59', 'Scare_date' => NULL, 'Tcare_date' => NULL],
            ['care_kind_id' => '15', 'category' => 'rest_grade', 'key' => 'absolute_rest', 'value' => '絶対安静', 'Fcare_date' => '23:59', 'Scare_date' => NULL, 'Tcare_date' => NULL]
        ]);
    }
}
