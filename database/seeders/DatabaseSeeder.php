<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            FacultySeeder::class,
            StudyProgramSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            // FakerUserSeeder::class,
            // ProposalSeeder::class,
        ]);
    }
}
