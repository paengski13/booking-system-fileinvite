<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = [
            [
                'name' => "Auckland",
                'is_bookable' => true
            ],
            [
                'name' => "Hamilton",
                'is_bookable' => false
            ],
            [
                'name' => "Wellington",
                'is_bookable' => true
            ],
            [
                'name' => "Christchurch",
                'is_bookable' => true
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
