<?php

namespace Database\Seeders;

use App\Models\TMedicine;
use App\Models\TPtschedule;
use Illuminate\Database\Seeder;

use Carbon\Carbon;


class TMedicineSeeder extends Seeder
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
            TMedicine::insert([
                't_medicine_id' => $i,
                'pt_schedule_id' => $i,
                'medicine_id' => $i,
                'daily_schedule_date' => today()
            ]);
        }



        // 追加で 11〜20件目を挿入（pt_schedule_idを複数同じにすることでその日に表示される薬の数を複数にする）
        // medicine_idも同じ数字になるためどの患者も出力されるものは同じになる
        // 本番環境では服薬する日を指定して登録しておく
        for ($i = 1; $i < 10; $i++) {
            TMedicine::insert([
                't_medicine_id' => $i + 10, // 重複しないように11〜20にする
                'pt_schedule_id' => $i,
                'medicine_id' => $i,
                'daily_schedule_date' => today()
            ]);
        }

        for ($i = 1; $i < 10; $i++) {
            TMedicine::insert([
                't_medicine_id' => $i + 20, // 重複しないように21〜30にする
                'pt_schedule_id' => $i,
                'medicine_id' => $i,
                'daily_schedule_date' => today()
            ]);
        }

    }


}
