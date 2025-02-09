<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate([
            'name' => 'ADMINISTRATOR',
        ],[
            'name' => 'ADMINISTRATOR',
            'guard_name' => 'web'
        ]);
        Role::firstOrCreate([
            'name' => 'MAHASISWA',
        ],[
            'name' => 'MAHASISWA',
            'guard_name' => 'web'
        ]);
        Role::firstOrCreate([
            'name' => 'DOSEN',
        ],[
            'name' => 'DOSEN',
            'guard_name' => 'web'
        ]);
        Role::firstOrCreate([
            'name' => 'PENALARAN',
        ],[
            'name' => 'PENALARAN',
            'guard_name' => 'web'
        ]);
        Role::firstOrCreate([
            'name' => 'PKM_CENTER',
        ],[
            'name' => 'PKM_CENTER',
            'guard_name' => 'web'
        ]);
    }
}
