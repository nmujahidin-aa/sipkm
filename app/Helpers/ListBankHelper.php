<?php

namespace App\Helpers;

class ListBankHelper
{
    public static function getListBank()
    {
        $banks = ['BCA', 'BNI', 'BRI', 'Mandiri', 'BSI', 'BTN', 'CIMB Niaga', 'Danamon', 'Maybank', 'OCBC NISP', 'Panin', 'Permata', 'UOB', 'Citibank', 'HSBC', 'JTrust', 'Mega', 'Muamalat', 'Bukopin', 'BTPN', 'DBS', 'MNC', 'Sinarmas', 'Bank Jatim'];
        return $banks;
    }
}
