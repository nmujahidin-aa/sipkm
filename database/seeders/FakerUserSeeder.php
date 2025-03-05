<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\StudyProgram;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Spatie\Permission\Models\Role;

class FakerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $now = now();

        // Ambil semua study program untuk mengacak faculty_id dan study_program_id
        $studyPrograms = StudyProgram::all();

        // Data untuk mahasiswa (9000 user)
        $mahasiswaData = [];
        for ($i = 0; $i < 900; $i++) {
            $studyProgram = $studyPrograms->random();
            $facultyId = $studyProgram->faculty_id;
            $nimPrefix = $faker->numberBetween(20, 24); // 2 digit awal (20-24)
            $facultyCode = str_pad($facultyId, 2, '0', STR_PAD_LEFT); // 2 digit faculty_id
            $nimSuffix = $faker->numerify('########'); // 8 digit random
            $nim = $nimPrefix . $facultyCode . $nimSuffix; // Gabungkan menjadi NIM 12 digit

            $mahasiswaData[] = [
                'email' => $faker->unique()->userName . '@students.um.ac.id',
                'name' => $faker->name,
                'nim' => $nim,
                'faculty_id' => $facultyId,
                'study_program_id' => $studyProgram->id,
                'password' => bcrypt('password'),
                'email_verified_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // Data untuk dosen (1000 user)
        $dosenData = [];
        for ($i = 0; $i < 100; $i++) {
            $studyProgram = $studyPrograms->random();
            $facultyId = $studyProgram->faculty_id;

            $dosenData[] = [
                'email' => $faker->unique()->userName . '@lecturers.um.ac.id',
                'name' => $faker->name,
                'faculty_id' => $facultyId,
                'study_program_id' => $studyProgram->id,
                'password' => bcrypt('password'),
                'email_verified_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // Batch insert untuk mahasiswa
        DB::table('users')->insert($mahasiswaData);

        // Batch insert untuk dosen
        DB::table('users')->insert($dosenData);

        // Assign role mahasiswa
        $mahasiswaUsers = User::where('email', 'like', '%@students.um.ac.id')->get();
        $mahasiswaRole = Role::findByName(RoleEnum::MAHASISWA);
        foreach ($mahasiswaUsers as $user) {
            $user->assignRole($mahasiswaRole);
        }

        // Assign role dosen
        $dosenUsers = User::where('email', 'like', '%@lecturers.um.ac.id')->get();
        $dosenRole = Role::findByName(RoleEnum::DOSEN);
        foreach ($dosenUsers as $user) {
            $user->assignRole($dosenRole);
        }
    }
}
