<?php


namespace App\Enum;


use BenSampo\Enum\Enum;

final class UserRole extends Enum
{
    const Administrator = 5;
    const Moderator = 4;
    const User = 1;
    const Verified = 0;
    const Unverified = null;


}
