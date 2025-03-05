<?php

namespace App\Helpers;

class MenuHelper
{
    public static $studentRoles = [2];
    public static $lecturerRoles = [3];
    public static $adminRoles = [1, 4, 5];

    public static function getMenuProposal($roleId)
    {
        if (in_array($roleId, self::$studentRoles)) {
            return 'proposal.index';
        } elseif (in_array($roleId, self::$lecturerRoles)) {
            return 'dosen.proposal.index';
        } elseif (in_array($roleId, self::$adminRoles)) {
            return 'admin.proposal.index';
        }

        return 'proposal.index';
    }

    public static function getMenuBelmawa($roleId)
    {
        if (in_array($roleId, self::$studentRoles)) {
            return 'belmawa.index';
        } elseif (in_array($roleId, self::$lecturerRoles)) {
            return 'dosen.belmawa.index';
        } elseif (in_array($roleId, self::$adminRoles)) {
            return 'admin.belmawa.index';
        }

        return 'belmawa.index';
    }


}
