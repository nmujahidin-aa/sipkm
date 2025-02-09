<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RoleEnum extends Enum
{
    const ADMINISTRATOR = 'ADMINISTRATOR';
    const MAHASISWA = 'MAHASISWA';
    const DOSEN = 'DOSEN';
    const PENALARAN = 'PENALARAN';
    const PKM_CENTER = 'PKM_CENTER';

    public static function roles()
    {
        $roles = [
            'ADMINISTRATOR',
            'MAHASISWA',
            'DOSEN',
            'PENALARAN',
            'PKM_CENTER',
        ];
        return $roles;
    }
}
