<?php

namespace App\Enum;

enum OrderingStatusType: string
{
    case draft = "draft";
    case pending = "pending";
    case canceled = "canceled";
    case working = "working";
    case completed = "completed";
    case rejected = "rejected";
}
