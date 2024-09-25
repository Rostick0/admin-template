<?php

namespace App\Enum;

enum StatusType: string
{
    case publish = "publish";
    case pending = "pending";
    case draft = "draft";
    case future = "future";
}
