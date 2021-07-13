<?php

namespace App\Enums;

class PhoneNumberRegex extends BaseEnum
{
    const CAMEROON = '/\(237\) ?[2368]\d{7,8}$/m';
    const ETHIOPIA = '/\(251\) ?[1-59]\d{8}$/m';
    const MOROCCO = '/\(212\) ?[5-9]\d{8}$/m';
    const MOZAMBIQUE = '/\(258\) ?[28]\d{7,8}$/m';
    const UGANDA = '/\(256\) ?\d{9}$/m';
}
