<?php

namespace Database\Seeders;

use App\Models\MRoom;
use Illuminate\Database\Seeder;

class MRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //MRoom::create([
        // 'room_name' => '101号室',
        // 'limited_capacity' => 6,
        // 'created_at' => now(),
        // 'updated_at' => now(),
        //]};
        for ($i = 1; $i < 10; $i++) {
            MRoom::create([
                'room_id' => $i,
                'room_name' => $i . '号室',
                'limited_capacity' => 4,
            ]);
        }
    }
}
