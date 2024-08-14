<?php

namespace App\Enums;

enum UserStatus: string
{
    case ENABLED = 'ENABLED';
    case DISABLED = 'DISABLED';
    case BLOCKED = 'BLOCKED';
}
