<?php

namespace App\Enums;

enum UserRole: string
{
    case SUPER_ADMIN = 'SUPER_ADMIN';
    case INSTRUCTOR = 'INSTRUCTOR';
    case STUDENT = 'STUDENT';
    case PARENT = 'PARENT';
}
