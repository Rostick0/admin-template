<?php

namespace App\Http\Controllers;

use App\Jobs\DownloadJob;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploaderController extends Controller
{

    public function download()
    {
        DownloadJob::dispatch();

        return new JsonResponse([
            'message' => 'Wait alert for install'
        ]);
    }

    public function upload() {}
}
