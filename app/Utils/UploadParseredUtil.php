<?php

namespace App\Utils;

use App\Enum\PropertyFieldType;
use App\Enum\ShopParserType;
use Illuminate\Support\Str;

class UploadParseredUtil
{
    public static function getType(string $name): string|null
    {
        $array_name = explode(
            ' ',
            str_replace(',', '', $name)
        );

        return count($array_name) > 1 ? last($array_name) : null;
    }

    public static function getValue($value, $unit = '')
    {
        return trim(str_replace(
            " $unit",
            '',
            explode(', ', $value)[0]
        ));
    }

    public static function setUnit($value)
    {
        if (array_search(
            explode(',', $value)[0],
            [ShopParserType::yes->value, ShopParserType::there_is->value, ShopParserType::absent->value]
        ) !== false) return PropertyFieldType::checkbox->value;


        if ((float) $value == $value) {
            return PropertyFieldType::input->value;
        }

        return PropertyFieldType::select->value;
    }

    public static function setPropertyValue($property_created, $value, $property_value_id = null)
    {
        if (PropertyFieldType::select->value !== $property_created['type']) {
            return [
                'value' => $value,
                'property_id' => $property_created->id,
            ];
        }

        return [
            'value' => null,
            'property_id' => $property_created->id,
            'property_value_id' => $property_value_id,
        ];
    }
}
