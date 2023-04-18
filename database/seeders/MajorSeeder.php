<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Models\Standard;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    public function run()
    {
        Major::create(['name' => 'Perdagangan Internasional S1']);
        Major::create(['name' => 'Perpustakaan & Sains Informasi S1']);
        Major::create(['name' => 'Produksi Film & Televisi D4']);
    }
}
