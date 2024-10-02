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
use Illuminate\Support\LazyCollection;
use Laravel\SerializableClosure\SerializableClosure;

class UploaderController extends Controller
{

    public function download(DownloadUploaderRequest $request)
    {
        $uploader = new ('App\Utils\Uploader\\' . $request->class);

        // $product = Product::cur;
        // $product = new Product();
        // dd($request->toArray());
        DownloadJob::dispatch(Product::class, $uploader, $request->toArray());

        // (new DownloadJob(Product::class, $uploader, $request->toArray()))->handle();

        return new JsonResponse([
            'message' => 'Wait alert for install'
        ]);
    }

    public function upload() {}
}
