<?php

namespace App\Helpers;

class RoleHelper
{
    public static function getRoleName($roleId)
    {
        $roles = [
            1 => 'ADMIN',
            2 => 'MAHASISWA',
            3 => 'DOSEN',
            4 => 'PENALARAN',
            5 => 'PKM CENTER',
        ];

        return $roles[$roleId] ?? 'UNKNOWN';
    }
}
