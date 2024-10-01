<?php

namespace App\Utils\Uploader;

use Illuminate\Support\Facades\Storage;
use Spatie\ArrayToXml\ArrayToXml;

class Xml extends AbstractUploader
{
    public static $extension = 'xml';
    public static $rootTag = 'root';
    public static $nameElem = 'item';
    public static function download($data, $random_name_with_extension)
    {
        $uploader = fn($data) => Storage::append($random_name_with_extension, $data);

        $uploader('<?xml version="1.0"?><'  . self::$rootTag . '>');
        foreach ($data as $index => $item) {
            $elem = trim(str_replace('<?xml version="1.0"?>', '', ArrayToXml::convert($item->toArray(), self::$nameElem)));
            $uploader($elem);
        }
        $uploader('</' . self::$rootTag . '>');
    }

    public static function upload() {}
}
