<?php

namespace App\Utils;

use App\Enum\PropertyFieldType;
use App\Enum\ShopParserType;

class UploadParseredUtil
{
    public static function getType(string $name): string|null
    {
        $array_name = explode(' ', $name);

        return count($array_name) > 1 ? last($array_name) : null;
    }

    public static function setUnit($property)
    {
        if (array_search(
            $property['value'],
            [ShopParserType::there_is->value, ShopParserType::absent->value]
        ) !== false) return PropertyFieldType::checkbox->value;

        return PropertyFieldType::input->value;
    }

    public static function setPropertyValue($property_created, $value, $unit)
    {
        if (PropertyFieldType::select->value !== $property_created['type']) {
            return [
                'value' => str_replace(" $unit", '', $value),
                'property_id' => $property_created->id,
                // 'property_value_id',
            ];
        }
    }
}
