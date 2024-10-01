<?php

namespace App\Utils\Uploader;

abstract class AbstractUploader
{
    public static $extension;
    public static function download($data, $random_name_with_extension) {}
    public static function upload() {}
}
