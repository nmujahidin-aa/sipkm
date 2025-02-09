<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\RoleEnum;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administratorUserData = [
            'email' => 'nur.mujahidin.2105336@students.um.ac.id',
            'name' => 'Nur Mujahidin Achmad Akbar',
            'nim' => '210533616011',
            'faculty_id' => '1',
            'study_program_id' => '3',
            'password' => bcrypt('idinakbar'),
            'email_verified_at' => date('Y-m-d H:i:s'),
        ];

        // Roles for the administrator user
        $administratorRoles = [
            RoleEnum::ADMINISTRATOR,
            RoleEnum::PKM_CENTER,
            RoleEnum::MAHASISWA,
        ];

        $otherUsers = [
            [
                'email' => 'haliza.putri.2103126@students.um.ac.id',
                'name' => 'Haliza Putri Iewsa Pratama',
                'nim' => '210312625306',
                'faculty_id' => '2',
                'study_program_id' => '43',
                'password' => bcrypt('password'),
                'email_verified_at' => date('Y-m-d H:i:s'),
            ],
            [
                'email' => 'achmad.mufti.2107116@students.um.ac.id',
                'name' => 'Achmad Mufti Fauzi',
                'nim' => '210711612053',
                'faculty_id' => '3',
                'study_program_id' => '64',
                'password' => bcrypt('password'),
                'email_verified_at' => date('Y-m-d H:i:s'),
            ],
            [
                'email' => 'salma.nilasalsabila.2106126@students.um.ac.id',
                'name' => 'Salma Nilasalsabila',
                'nim' => '210612608915',
                'faculty_id' => '7',
                'study_program_id' => '61',
                'password' => bcrypt('password'),
                'email_verified_at' => date('Y-m-d H:i:s'),
            ],
            [
                'email' => 'alda.alfina.2203416@students.um.ac.id',
                'name' => 'Alda Alfina',
                'nim' => '220341606001',
                'faculty_id' => '2',
                'study_program_id' => '48',
                'password' => bcrypt('password'),
                'email_verified_at' => date('Y-m-d H:i:s'),
            ],
            [
                'email' => 'rosa.okta.2106126@students.um.ac.id',
                'name' => 'Rosa Okta Risma Widyaningsih',
                'nim' => '210612608954',
                'faculty_id' => '7',
                'study_program_id' => '61',
                'password' => bcrypt('password'),
                'email_verified_at' => date('Y-m-d H:i:s'),
            ],
            [
                'email' => 'nimas.candhyta.2204326@students.um.ac.id',
                'name' => 'Nimas Candhyta Maharani',
                'nim' => '220432606061',
                'faculty_id' => '10',
                'study_program_id' => '59',
                'password' => bcrypt('password'),
                'email_verified_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert administrator user
        $adminUser = User::firstOrCreate(['email' => $administratorUserData['email']], $administratorUserData);
        foreach ($administratorRoles as $role) {
            $adminUser->assignRole($role);
        }

        // Insert other users with fixed roles
        $roles = [RoleEnum::MAHASISWA, RoleEnum::PKM_CENTER];
        foreach ($otherUsers as $userData) {
            $user = User::firstOrCreate(['email' => $userData['email']], $userData);
            foreach ($roles as $role) {
                $user->assignRole($role);
            }
        }
    }

}
