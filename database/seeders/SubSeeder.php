<?php

namespace Database\Seeders;

use App\Models\Standard;
use App\Models\Sub;
use Illuminate\Database\Seeder;

class SubSeeder extends Seeder
{
    public function run()
    {
        $standardID = Standard::first()->id;

        Sub::create(['name' => 'Sub A', 'number' => '1.1', 'standard_id' => $standardID, 'description' => 'Deksripsi dari Sub A']);
        Sub::create(['name' => 'Sub B', 'number' => '1.2', 'standard_id' => $standardID, 'description' => 'Deksripsi dari Sub B']);
        Sub::create(['name' => 'Sub C', 'number' => '1.3', 'standard_id' => $standardID, 'description' => 'Deksripsi dari Sub C']);
    }
}
