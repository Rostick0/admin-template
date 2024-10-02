<?php

namespace App\Utils\Uploader;

use Illuminate\Support\Facades\Storage;

class Csv extends AbstractUploader
{
    public static $extension = 'csv';

    public static function download($data, $random_name_with_extension)
    {
        $output = fopen(Storage::path($random_name_with_extension), 'w');
        foreach ($data as $index => $item) {
            fputcsv($output, $item->toArray());
        }

        fclose($output);
    }

    public static function upload() {}
}
