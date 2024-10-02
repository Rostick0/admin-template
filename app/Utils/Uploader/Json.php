<?php

namespace App\Utils\Uploader;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\LazyCollection;

class Json extends AbstractUploader
{
    public static $extension = 'json';
    public static function download($data, $random_name_with_extension)
    {
        $uploader = fn($data) => Storage::append($random_name_with_extension, $data);

        $uploader('[');
        $last_index = count($data);
        foreach ($data as $index => $item) {
            $uploader(json_encode($item) . ($last_index - 1 !== $index ? ',' : ''));
        }
        $uploader(']');
    }

    public static function upload() {}
}
