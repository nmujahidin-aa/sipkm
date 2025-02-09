<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faculty;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faculties = [
            [
                'id' => '1',
                'name' => 'Fakultas Teknik',
                'short_name' => 'FT',
                'color' => '#ff0000',
            ],
            [
                'id' => '2',
                'name' => 'Fakultas Matematika dan Ilmu Pengetahuan Alam',
                'short_name' => 'FMIPA',
                'color' => '#00ff00',
            ],
            [
                'id' => '3',
                'name' => 'Fakultas Ilmu Sosial',
                'short_name' => 'FIS',
                'color' => '#9900ff',
            ],
            [
                'id' => '4',
                'name' => 'Fakultas Ilmu Pendidikan',
                'short_name' => 'FIP',
                'color' => '#ffffff',
            ],
            [
                'id' => '5',
                'name' => 'Fakultas Sastra',
                'short_name' => 'FS',
                'color' => '#ffff00',
            ],
            [
                'id' => '6',
                'name' => 'Fakultas Psikologi',
                'short_name' => 'FPsi',
                'color' => '#ff00ff',
            ],
            [
                'id' => '7',
                'name' => 'Fakultas ilmu Keolahragaan',
                'short_name' => 'FIK',
                'color' => '#66e6e6',
            ],
            [
                'id' => '8',
                'name' => 'Fakultas Kedokteran',
                'short_name' => 'FK',
                'color' => '#41e0d1',
            ],
            [
                'id' => '9',
                'name' => 'Fakultas Vokasi',
                'short_name' => 'FV',
                'color' => '#ff6600',
            ],
            [
                'id' => '10',
                'name' => 'Fakultas Eknomi dan Bisnis',
                'short_name' => 'FEB',
                'color' => '#00ffff',
            ],
        ];

        foreach ($faculties as $faculty) {
            \App\Models\Faculty::create($faculty);
        }
    }
}
