<?php

namespace App\Utils\Uploader;

use Spatie\ArrayToXml\ArrayToXml;

class Xml extends AbstractUploader
{
    public static $extension = 'xml';
    public static $rootTag = 'root';
    public static $nameElem = 'item';
    public static function download($data, $uploader)
    {
        $uploader('<?xml version="1.0"?><'  . self::$rootTag . '>');
        foreach ($data as $index => $item) {
            $elem = trim(str_replace('<?xml version="1.0"?>', '', ArrayToXml::convert($item->toArray(), self::$nameElem)));
            $uploader($elem);
        }
        $uploader('</' . self::$rootTag . '>');
    }

    public static function upload() {}
}
