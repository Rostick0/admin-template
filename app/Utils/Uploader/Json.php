<?php

namespace App\Utils\Uploader;

use Illuminate\Support\LazyCollection;

class Json extends AbstractUploader
{
    public static $extension = 'json';
    public static function download($data, $uploader)
    {
        $uploader('[');
        $last_index = count($data);
        foreach ($data as $index => $item) {
            $uploader(json_encode($item) . ($last_index - 1 !== $index ? ',' : ''));
        }
        $uploader(']');
    }

    public static function upload() {}
}
