<?php

namespace Database\Seeders;

use App\Models\MMeal;
use Illuminate\Database\Seeder;

class MMealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        MMeal::insert([
            ['meal_id' => '1', 'food_name' => '普通食', 'food_form' => 'フリー', 'food_time' => '8:00', 'food_time_label' => '朝'],
            ['meal_id' => '2', 'food_name' => '普通食', 'food_form' => 'フリー', 'food_time' => '12:00', 'food_time_label' => '昼'],
            ['meal_id' => '3', 'food_name' => '普通食', 'food_form' => 'フリー', 'food_time' => '18:00', 'food_time_label' => '夜'],
            ['meal_id' => '4', 'food_name' => '普通食', 'food_form' => 'きざみ', 'food_time' => '8:00', 'food_time_label' => '朝'],
            ['meal_id' => '5', 'food_name' => '普通食', 'food_form' => 'きざみ', 'food_time' => '12:00', 'food_time_label' => '昼'],
            ['meal_id' => '6', 'food_name' => '普通食', 'food_form' => 'きざみ', 'food_time' => '18:00', 'food_time_label' => '夜'],
            ['meal_id' => '7', 'food_name' => '普通食', 'food_form' => 'ペースト', 'food_time' => '8:00', 'food_time_label' => '朝'],
            ['meal_id' => '8', 'food_name' => '普通食', 'food_form' => 'ペースト', 'food_time' => '12:00', 'food_time_label' => '昼'],
            ['meal_id' => '9', 'food_name' => '普通食', 'food_form' => 'ペースト', 'food_time' => '18:00', 'food_time_label' => '夜'],
            ['meal_id' => '10', 'food_name' => '腎臓食', 'food_form' => 'フリー', 'food_time' => '8:00', 'food_time_label' => '朝'],
            ['meal_id' => '11', 'food_name' => '腎臓食', 'food_form' => 'フリー', 'food_time' => '12:00', 'food_time_label' => '昼'],
            ['meal_id' => '12', 'food_name' => '腎臓食', 'food_form' => 'フリー', 'food_time' => '18:00', 'food_time_label' => '夜'],
            ['meal_id' => '13', 'food_name' => '腎臓食', 'food_form' => 'きざみ', 'food_time' => '8:00', 'food_time_label' => '朝'],
            ['meal_id' => '14', 'food_name' => '腎臓食', 'food_form' => 'きざみ', 'food_time' => '12:00', 'food_time_label' => '昼'],
            ['meal_id' => '15', 'food_name' => '腎臓食', 'food_form' => 'きざみ', 'food_time' => '18:00', 'food_time_label' => '夜'],
            ['meal_id' => '16', 'food_name' => '腎臓食', 'food_form' => 'ペースト', 'food_time' => '8:00', 'food_time_label' => '朝'],
            ['meal_id' => '17', 'food_name' => '腎臓食', 'food_form' => 'ペースト', 'food_time' => '12:00', 'food_time_label' => '昼'],
            ['meal_id' => '18', 'food_name' => '腎臓食', 'food_form' => 'ペースト', 'food_time' => '18:00', 'food_time_label' => '夜'],
            ['meal_id' => '19', 'food_name' => '肝臓食', 'food_form' => 'フリー', 'food_time' => '8:00', 'food_time_label' => '朝'],
            ['meal_id' => '20', 'food_name' => '肝臓食', 'food_form' => 'フリー', 'food_time' => '12:00', 'food_time_label' => '昼'],
            ['meal_id' => '21', 'food_name' => '肝臓食', 'food_form' => 'フリー', 'food_time' => '18:00', 'food_time_label' => '夜'],
            ['meal_id' => '22', 'food_name' => '肝臓食', 'food_form' => 'きざみ', 'food_time' => '8:00', 'food_time_label' => '朝'],
            ['meal_id' => '23', 'food_name' => '肝臓食', 'food_form' => 'きざみ', 'food_time' => '12:00', 'food_time_label' => '昼'],
            ['meal_id' => '24', 'food_name' => '肝臓食', 'food_form' => 'きざみ', 'food_time' => '18:00', 'food_time_label' => '夜'],
            ['meal_id' => '25', 'food_name' => '肝臓食', 'food_form' => 'ペースト', 'food_time' => '8:00', 'food_time_label' => '朝'],
            ['meal_id' => '26', 'food_name' => '肝臓食', 'food_form' => 'ペースト', 'food_time' => '12:00', 'food_time_label' => '昼'],
            ['meal_id' => '27', 'food_name' => '肝臓食', 'food_form' => 'ペースト', 'food_time' => '18:00', 'food_time_label' => '夜'],
            ['meal_id' => '28', 'food_name' => '経管栄養', 'food_form' => '', 'food_time' => '8:00', 'food_time_label' => '朝'],
            ['meal_id' => '29', 'food_name' => '経管栄養', 'food_form' => '', 'food_time' => '12:00', 'food_time_label' => '昼'],
            ['meal_id' => '30', 'food_name' => '経管栄養', 'food_form' => '', 'food_time' => '18:00', 'food_time_label' => '夜'],
        ]);


    }
}
