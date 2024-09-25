<?php

namespace App\Utils;

class EnumFields
{
    public static function getColumn($enum)
    {
        return array_column($enum::cases(), 'value');
    }

    public static function getValidateValues($enum)
    {
        return implode(',', self::getColumn($enum));
    }
}
