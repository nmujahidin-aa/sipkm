<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Data Administrator
        $administrator = [
            'email' => 'nur.mujahidin.2105336@students.um.ac.id',
            'name' => 'Nur Mujahidin Achmad Akbar',
            'nim' => '210533616011',
            'faculty_id' => '1',
            'study_program_id' => '3',
            'password' => bcrypt('idinakbar'),
            'email_verified_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        // Data PKM Center (Mahasiswa)
        $pkmCenter = [
            ['email' => 'haliza.putri.2103126@students.um.ac.id', 'name' => 'Haliza Putri Iewsa Pratama', 'nim' => '210312625306', 'faculty_id' => '2', 'study_program_id' => '43'],
            ['email' => 'achmad.mufti.2107116@students.um.ac.id', 'name' => 'Achmad Mufti Fauzi', 'nim' => '210711612053', 'faculty_id' => '3', 'study_program_id' => '64'],
            ['email' => 'salma.nilasalsabila.2106126@students.um.ac.id', 'name' => 'Salma Nilasalsabila', 'nim' => '210612608915', 'faculty_id' => '7', 'study_program_id' => '61'],
            ['email' => 'alda.alfina.2203416@students.um.ac.id', 'name' => 'Alda Alfina', 'nim' => '220341606001', 'faculty_id' => '2', 'study_program_id' => '48'],
            ['email' => 'rosa.okta.2106126@students.um.ac.id', 'name' => 'Rosa Okta Risma Widyaningsih', 'nim' => '210612608954', 'faculty_id' => '7', 'study_program_id' => '61'],
            ['email' => 'nimas.candhyta.2204326@students.um.ac.id', 'name' => 'Nimas Candhyta Maharani', 'nim' => '220432606061', 'faculty_id' => '10', 'study_program_id' => '59'],
        ];

        // Data Dosen
        $lecturer = [
            'email' => 'lucky.radita.fik@um.ac.id',
            'name' => 'Lucky Radita Alma, S.K.M., M.P.H.',
            'nip' => '198911162019032017',
            'faculty_id' => '7',
            'study_program_id' => '61',
            'password' => bcrypt('password'),
            'email_verified_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        // Tambahkan field yang diperlukan untuk semua user PKM Center
        foreach ($pkmCenter as &$user) {
            $user['password'] = bcrypt('password');
            $user['email_verified_at'] = $now;
            $user['created_at'] = $now;
            $user['updated_at'] = $now;
        }
        unset($user); // Unset reference untuk menghindari bug di PHP

        // Gabungkan semua data
        $users = array_merge([$administrator], $pkmCenter, [$lecturer]);

        // Batch Insert ke database
        DB::table('users')->insert($users);

        // Ambil kembali user yang telah dimasukkan sekaligus
        $users = User::whereIn('email', array_column($users, 'email'))->get();

        // Tetapkan Role
        foreach ($users as $user) {
            if ($user->email === $administrator['email']) {
                $user->assignRole(RoleEnum::ADMINISTRATOR, RoleEnum::PKM_CENTER, RoleEnum::MAHASISWA);
            } elseif ($user->email === $lecturer['email']) {
                $user->assignRole(RoleEnum::DOSEN, RoleEnum::PENALARAN);
            } else {
                $user->assignRole(RoleEnum::MAHASISWA, RoleEnum::PKM_CENTER);
            }
        }
    }
}
