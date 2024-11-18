<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'PIJAY',
            'username' => 'superAdmin',
            'role' => 'Super Admin',
            'nohp' => '082180864290',
            'password' => bcrypt(1),
        ]);
        \App\Models\Bidang::create([
            'name' => 'Binkesmas',
        ]);
        \App\Models\Bidang::create([
            'name' => 'P2',
        ]);
        \App\Models\Bidang::create([
            'name' => 'Yankes',
        ]);
        \App\Models\Bidang::create([
            'name' => 'Puskesmas',
        ]);
        \App\Models\Bidang::create([
            'name' => 'Sekretariat',
        ]);
        for ($i = 1; $i <= 4; $i++) {
            \App\Models\Triwulan::create([
                'name' => 'TW ' . $i,
            ]);
        }
    }
}
