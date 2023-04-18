<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Major;
use App\Models\User;
use http\Env;
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
            RolePermissionSeeder::class,
            StandardSeeder::class,
            MajorSeeder::class,
            SubSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => \env('EMAIL_SUPER_ADMIN'),
            'password' => \Hash::make(\env('PASSWORD_SUPER_ADMIN')),
        ])->assignRole(['super admin']);
    }
}
