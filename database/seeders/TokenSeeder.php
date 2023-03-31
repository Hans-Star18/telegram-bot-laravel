<?php

namespace Database\Seeders;

use App\Models\Token;
use Illuminate\Database\Seeder;

class TokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Token::insert([
            [
                'token' => 'ASDFGHJK',
                'drawbox_id' => 1,
                'chance' => 1,
                'is_claimed' => false,
            ],
            [
                'token' => 'WKWKWKWK',
                'drawbox_id' => 1,
                'chance' => 1,
                'is_claimed' => false,
            ],
            [
                'token' => 'HEHEHEHE',
                'drawbox_id' => 2,
                'chance' => 2,
                'is_claimed' => false,
            ],
            [
                'token' => 'HOHOHOHO',
                'drawbox_id' => 3,
                'chance' => 1,
                'is_claimed' => false,
            ],
        ]);
    }
}
