<?php

namespace Database\Seeders;

use App\Models\Drawbox;
use Illuminate\Database\Seeder;

class DrawboxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Drawbox::insert([
            [
                'box' => 'A',
            ],
            [
                'box' => 'B',
            ],
            [
                'box' => 'C',
            ],
        ]);
    }
}
