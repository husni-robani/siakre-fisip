<?php

namespace App\Enums;

enum TimelineStatus: string
{
    case Upload = 'Upload';
    case Delete = 'Delete';
    case Verified = 'Verified';
}
