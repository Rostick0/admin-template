<?php

namespace App\Http\Controllers;

use App\Http\Requests\Uploader\DownloadUploaderRequest;
use App\Jobs\DownloadJob;
use App\Models\Post;
use App\Models\Product;
use App\Utils\Uploader\Json;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploaderController extends Controller
{

    public function download(DownloadUploaderRequest $request)
    {
        $uploader = new ('App\Utils\Uploader\\' . $request->class);
        (new DownloadJob(Product::cursor(), $uploader))->handle();
        // DownloadJob::dispatch(Product::cursor(), Json::class);

        return new JsonResponse([
            'message' => 'Wait alert for install'
        ]);
    }

    public function upload() {}
}
