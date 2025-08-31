<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            MUserSeeder::class,
            MRoomSeeder::class,
            MCarekindSeeder::class,
            MDialysisSeeder::class,
            MDiseaseSeeder::class,
            MMealSeeder::class,
            MMedicineSeeder::class,
            MPatientSeeder::class,
            MTreatmentkindSeeder::class,
            TAssignedSeeder::class,
            TMedicalrecordSeeder::class,
            TPtscheduleSeeder::class,
            TPtDialysisSeeder::class,
            TTreatmentkindSeeder::class,
            TCarekindSeeder::class,
            TMedicineSeeder::class,
            TMealSeeder::class,
            // \App\Models\User::factory(10)->create();
        ]);
    }
}
