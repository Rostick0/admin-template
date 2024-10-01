<?php

namespace App\Utils\Uploader;

use Illuminate\Support\Facades\Storage;

class Csv extends AbstractUploader
{
    public static $extension = 'csv';

    public static function download($data, $random_name_with_extension)
    {
        // dd(storage_path($random_name_with_extension));
        // dd($random_name_with_extension);
        $output = fopen(Storage::path($random_name_with_extension), 'w');
        // $uploader('<?xml version=1.0<'  . self::$rootTag . '>');
        foreach ($data as $index => $item) {
            // dd(csv($item));
            fputcsv($output, $item->toArray());
            // $elem = trim(str_replace('<?xml version="1.0"', '', ArrayToXml::convert($item->toArray(), self::$nameElem)));
            // $uploader($elem);
        }

        fclose($output);
        // $uploader('</' . self::$rootTag . '>');
    }

    public static function upload() {}
}
