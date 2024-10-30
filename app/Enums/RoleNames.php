<?php

namespace App\Enums;

enum RoleNames: string
{
    use ToArray;

    case ADMIN = 'admin';
    case CUSTOMER = 'customer';
}
