<?php

namespace App\Http\Controllers;

use App\Events\Notice as EventsNotice;
use App\Http\Requests\Uploader\DownloadUploaderRequest;
use App\Jobs\DownloadJob;
use App\Models\Notice;
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
        $model =  ('App\Models\\' . $request->model);
        $uploader = new ('App\Utils\Uploader\\' . $request->type);

        DownloadJob::dispatch(
            $model,
            $uploader,
            $request->toArray(),
            $request->user(),
            [],
            [['user_id', '=', $request->user()->id]]
        );

        return new JsonResponse([
            'message' => 'Wait alert for install'
        ]);
    }

    public function upload() {}
}
