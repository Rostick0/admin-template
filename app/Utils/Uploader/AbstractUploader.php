<?php

namespace App\Utils\Uploader;

abstract class AbstractUploader
{
    public static $extension;
    public static function download($data, $uploader) {}
    public static function upload() {}
}
