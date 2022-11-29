<?php

namespace Database\Seeders;

use App\Models\JenisToko;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisTokoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisToko::insert([
            [
                'id' => 1,
                'name' => 'senggol',
            ],
            [
                'id' => 2,
                'name' => 'los',
            ],
            [
                'id' => 3,
                'name' => 'ruko',
            ],
            [
                'id' => 4,
                'name' => 'garasi',
            ],
        ]);
    }
}
