<?php

namespace Database\Seeders;

use App\Models\MTreatmentkind;
use Illuminate\Database\Seeder;

class MTreatmentkindSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        MTreatmentkind::insert([
            ['treatment_kind_id' => '1', 'category' => 'treatment', 'key' => 'skincare', 'value' => '褥瘡処置', 'Ftreatment_date' => '10:00', 'Streatment_date' => NULL, 'Ttreatment_date' => NULL],
            ['treatment_kind_id' => '2', 'category' => 'treatment', 'key' => 'change_of_position', 'value' => '体位変換', 'Ftreatment_date' => '23:59', 'Streatment_date' => NULL, 'Ttreatment_date' => NULL],
            ['treatment_kind_id' => '3', 'category' => 'treatment', 'key' => 'enema', 'value' => '浣腸', 'Ftreatment_date' => '23:59', 'Streatment_date' => NULL, 'Ttreatment_date' => NULL],
            ['treatment_kind_id' => '4', 'category' => 'treatment', 'key' => 'stoma_care', 'value' => 'ストマケア', 'Ftreatment_date' => '10:00', 'Streatment_date' => NULL, 'Ttreatment_date' => NULL],
            ['treatment_kind_id' => '5', 'category' => 'check', 'key' => 'vital_sign', 'value' => 'バイタル測定', 'Ftreatment_date' => '9:00', 'Streatment_date' => '15:00', 'Ttreatment_date' => '20:00'],
            ['treatment_kind_id' => '6', 'category' => 'check', 'key' => 'blood_collection', 'value' => '採血', 'Ftreatment_date' => '10:00', 'Streatment_date' => NULL, 'Ttreatment_date' => NULL],
            ['treatment_kind_id' => '7', 'category' => 'check', 'key' => 'X_ray', 'value' => 'レントゲン', 'Ftreatment_date' => '10:00', 'Streatment_date' => NULL, 'Ttreatment_date' => NULL],
            ['treatment_kind_id' => '8', 'category' => 'check', 'key' => 'CT', 'value' => 'CT', 'Ftreatment_date' => '10:00', 'Streatment_date' => NULL, 'Ttreatment_date' => NULL],
            ['treatment_kind_id' => '9', 'category' => 'check', 'key' => 'MRI', 'value' => 'MRI', 'Ftreatment_date' => '10:00', 'Streatment_date' => NULL, 'Ttreatment_date' => NULL],
            ['treatment_kind_id' => '10', 'category' => 'check', 'key' => 'electro_cardiogram', 'value' => '心電図', 'Ftreatment_date' => '10:00', 'Streatment_date' => NULL, 'Ttreatment_date' => NULL],
            ['treatment_kind_id' => '11', 'category' => 'check_data', 'key' => 'blood', 'value' => '血液データ', 'Ftreatment_date' => '10:00', 'Streatment_date' => NULL, 'Ttreatment_date' => NULL],
            ['treatment_kind_id' => '12', 'category' => 'check_data', 'key' => 'X_ray', 'value' => 'レントゲン', 'Ftreatment_date' => '10:00', 'Streatment_date' => NULL, 'Ttreatment_date' => NULL],
            ['treatment_kind_id' => '13', 'category' => 'check_data', 'key' => 'CT', 'value' => 'CT', 'Ftreatment_date' => '10:00', 'Streatment_date' => NULL, 'Ttreatment_date' => NULL],
            ['treatment_kind_id' => '14', 'category' => 'check_data', 'key' => 'MRI', 'value' => 'MRI', 'Ftreatment_date' => '10:00', 'Streatment_date' => NULL, 'Ttreatment_date' => NULL],
            ['treatment_kind_id' => '15', 'category' => 'check_data', 'key' => 'electro_cardiogra', 'value' => '心電図', 'Ftreatment_date' => '10:00', 'Streatment_date' => NULL, 'Ttreatment_date' => NULL],
            ['treatment_kind_id' => '16', 'category' => 'rehabilitation', 'key' => 'OT', 'value' => '作業療法', 'Ftreatment_date' => '10:00', 'Streatment_date' => NULL, 'Ttreatment_date' => NULL],
            ['treatment_kind_id' => '17', 'category' => 'rehabilitation', 'key' => 'PT', 'value' => '理学療法', 'Ftreatment_date' => '10:00', 'Streatment_date' => '15:00', 'Ttreatment_date' => NULL],
            ['treatment_kind_id' => '18', 'category' => 'rehabilitation', 'key' => 'ST', 'value' => '言語聴覚療法', 'Ftreatment_date' => '9:00', 'Streatment_date' => NULL, 'Ttreatment_date' => NULL],
            ['treatment_kind_id' => '19', 'category' => 'operation', 'key' => 'apppendicitis', 'value' => '虫垂炎', 'Ftreatment_date' => '9:00', 'Streatment_date' => NULL, 'Ttreatment_date' => NULL],
            ['treatment_kind_id' => '20', 'category' => 'operation', 'key' => 'ileus', 'value' => 'イレウス', 'Ftreatment_date' => '9:00', 'Streatment_date' => NULL, 'Ttreatment_date' => NULL],
            ['treatment_kind_id' => '21', 'category' => 'operation', 'key' => 'TEVER', 'value' => 'TEVER', 'Ftreatment_date' => '9:00', 'Streatment_date' => NULL, 'Ttreatment_date' => NULL],
        ]);
    }
}
