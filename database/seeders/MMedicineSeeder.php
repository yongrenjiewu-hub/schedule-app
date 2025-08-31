<?php

namespace Database\Seeders;

use App\Models\MMedicine;
use Illuminate\Database\Seeder;

class MMedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        MMedicine::insert([
            ['medicine_id' => '1', 'kinds' => '鎮痛剤', 'drug_name' => 'アスピリン', 'usage' => '１錠', 'dose' => '1日２回まで', 'medicine_time' => '9:00', 'medicine_time_label' => '朝'],
            ['medicine_id' => '2', 'kinds' => '鎮痛剤', 'drug_name' => 'アスピリン', 'usage' => '１錠', 'dose' => '1日２回まで', 'medicine_time' => '13:00', 'medicine_time_label' => '昼'],
            ['medicine_id' => '3', 'kinds' => '鎮痛剤', 'drug_name' => 'アスピリン', 'usage' => '１錠', 'dose' => '1日２回まで', 'medicine_time' => '18:00', 'medicine_time_label' => '夜'],
            ['medicine_id' => '4', 'kinds' => '鎮痛剤', 'drug_name' => 'ロキソプロフェン', 'usage' => '１錠', 'dose' => '1日２回まで', 'medicine_time' => '9:00', 'medicine_time_label' => '朝'],
            ['medicine_id' => '5', 'kinds' => '鎮痛剤', 'drug_name' => 'ロキソプロフェン', 'usage' => '１錠', 'dose' => '1日２回まで', 'medicine_time' => '13:00', 'medicine_time_label' => '昼'],
            ['medicine_id' => '6', 'kinds' => '鎮痛剤', 'drug_name' => 'ロキソプロフェン', 'usage' => '１錠', 'dose' => '1日２回まで', 'medicine_time' => '18:00', 'medicine_time_label' => '夜'],
            ['medicine_id' => '7', 'kinds' => '鎮痛剤', 'drug_name' => 'カロナール', 'usage' => '１錠', 'dose' => '1日２回まで', 'medicine_time' => '9:00', 'medicine_time_label' => '朝'],
            ['medicine_id' => '8', 'kinds' => '鎮痛剤', 'drug_name' => 'カロナール', 'usage' => '１錠', 'dose' => '1日２回まで', 'medicine_time' => '13:00', 'medicine_time_label' => '昼'],
            ['medicine_id' => '9', 'kinds' => '鎮痛剤', 'drug_name' => 'カロナール', 'usage' => '１錠', 'dose' => '1日２回まで', 'medicine_time' => '18:00', 'medicine_time_label' => '夜'],
            ['medicine_id' => '10', 'kinds' => '鎮痛剤', 'drug_name' => 'イブプロフェン', 'usage' => '１錠', 'dose' => '1日２回まで', 'medicine_time' => '9:00', 'medicine_time_label' => '朝'],
            ['medicine_id' => '11', 'kinds' => '鎮痛剤', 'drug_name' => 'イブプロフェン', 'usage' => '１錠', 'dose' => '1日２回まで', 'medicine_time' => '13:00', 'medicine_time_label' => '昼'],
            ['medicine_id' => '12', 'kinds' => '鎮痛剤', 'drug_name' => 'イブプロフェン', 'usage' => '１錠', 'dose' => '1日２回まで', 'medicine_time' => '18:00', 'medicine_time_label' => '夜'],
            ['medicine_id' => '13', 'kinds' => '鎮静剤', 'drug_name' => 'ミタゾラム', 'usage' => '20ml', 'dose' => '1日２回まで', 'medicine_time' => '9:00', 'medicine_time_label' => '朝'],
            ['medicine_id' => '14', 'kinds' => '鎮静剤', 'drug_name' => 'ミタゾラム', 'usage' => '20ml', 'dose' => '1日２回まで', 'medicine_time' => '13:00', 'medicine_time_label' => '昼'],
            ['medicine_id' => '15', 'kinds' => '鎮静剤', 'drug_name' => 'ミタゾラム', 'usage' => '20ml', 'dose' => '1日２回まで', 'medicine_time' => '18:00', 'medicine_time_label' => '夜'],
            ['medicine_id' => '16', 'kinds' => '鎮静剤', 'drug_name' => 'プロポフォール', 'usage' => '20ml', 'dose' => '持続投与', 'medicine_time' => '9:00', 'medicine_time_label' => '朝'],
            ['medicine_id' => '17', 'kinds' => '鎮静剤', 'drug_name' => 'プロポフォール', 'usage' => '20ml', 'dose' => '持続投与', 'medicine_time' => '13:00', 'medicine_time_label' => '昼'],
            ['medicine_id' => '18', 'kinds' => '鎮静剤', 'drug_name' => 'プロポフォール', 'usage' => '20ml', 'dose' => '持続投与', 'medicine_time' => '18:00', 'medicine_time_label' => '夜'],
            ['medicine_id' => '19', 'kinds' => '抗生剤', 'drug_name' => 'ペニシリンG', 'usage' => '20ml', 'dose' => '３回/日', 'medicine_time' => '9:00', 'medicine_time_label' => '朝'],
            ['medicine_id' => '20', 'kinds' => '抗生剤', 'drug_name' => 'ペニシリンG', 'usage' => '20ml', 'dose' => '３回/日', 'medicine_time' => '13:00', 'medicine_time_label' => '昼'],
            ['medicine_id' => '21', 'kinds' => '抗生剤', 'drug_name' => 'ペニシリンG', 'usage' => '20ml', 'dose' => '３回/日', 'medicine_time' => '18:00', 'medicine_time_label' => '夜'],
            ['medicine_id' => '22', 'kinds' => '抗生剤', 'drug_name' => 'セファゾリン', 'usage' => '20ml', 'dose' => '３回/日', 'medicine_time' => '9:00', 'medicine_time_label' => '朝'],
            ['medicine_id' => '23', 'kinds' => '抗生剤', 'drug_name' => 'セファゾリン', 'usage' => '20ml', 'dose' => '３回/日', 'medicine_time' => '13:00', 'medicine_time_label' => '昼'],
            ['medicine_id' => '24', 'kinds' => '抗生剤', 'drug_name' => 'セファゾリン', 'usage' => '20ml', 'dose' => '３回/日', 'medicine_time' => '18:00', 'medicine_time_label' => '夜'],
            ['medicine_id' => '25', 'kinds' => '抗生剤', 'drug_name' => 'エリスロマイシン', 'usage' => '20ml', 'dose' => '３回/日', 'medicine_time' => '9:00', 'medicine_time_label' => '朝'],
            ['medicine_id' => '26', 'kinds' => '抗生剤', 'drug_name' => 'エリスロマイシン', 'usage' => '20ml', 'dose' => '３回/日', 'medicine_time' => '13:00', 'medicine_time_label' => '昼'],
            ['medicine_id' => '27', 'kinds' => '抗生剤', 'drug_name' => 'エリスロマイシン', 'usage' => '20ml', 'dose' => '３回/日', 'medicine_time' => '18:00', 'medicine_time_label' => '夜'],
            ['medicine_id' => '28', 'kinds' => '抗生剤', 'drug_name' => 'バンコマイシン', 'usage' => '20ml', 'dose' => '３回/日', 'medicine_time' => '9:00', 'medicine_time_label' => '朝'],
            ['medicine_id' => '29', 'kinds' => '抗生剤', 'drug_name' => 'バンコマイシン', 'usage' => '20ml', 'dose' => '３回/日', 'medicine_time' => '13:00', 'medicine_time_label' => '昼'],
            ['medicine_id' => '30', 'kinds' => '抗生剤', 'drug_name' => 'バンコマイシン', 'usage' => '20ml', 'dose' => '３回/日', 'medicine_time' => '18:00', 'medicine_time_label' => '夜'],
        ]);
    }
}
