<?php

namespace Database\Seeders;

use App\Models\BoxItem;
use Illuminate\Database\Seeder;

class BoxItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BoxItem::insert([
            [
                'drawbox_id' => 1,
                'item' => 'sendal',
                'image' => 'assets/images/a-sandal.jpg',
            ],
            [
                'drawbox_id' => 1,
                'item' => 'sepatu',
                'image' => 'assets/images/a-sepatu.jpg',
            ],
            [
                'drawbox_id' => 1,
                'item' => 'tas',
                'image' => 'assets/images/a-tas.png',
            ],
            [
                'drawbox_id' => 2,
                'item' => 'baju',
                'image' => 'assets/images/b-baju.jpg',
            ],
            [
                'drawbox_id' => 2,
                'item' => 'jaket',
                'image' => 'assets/images/b-jaket.jpg',
            ],
            [
                'drawbox_id' => 2,
                'item' => 'tas',
                'image' => 'assets/images/b-tas.png',
            ],
            [
                'drawbox_id' => 3,
                'item' => 'gaun',
                'image' => 'assets/images/c-gaun.jpg',
            ],
            [
                'drawbox_id' => 3,
                'item' => 'jaket',
                'image' => 'assets/images/c-jaket.jpg',
            ],
        ]);
    }
}
