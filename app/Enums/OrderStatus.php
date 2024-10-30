<?php

namespace App\Enums;

enum OrderStatus: string
{
    use ToArray;

    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case SUCCEEDED = 'succeeded';
    case FAILED = 'failed';
}
