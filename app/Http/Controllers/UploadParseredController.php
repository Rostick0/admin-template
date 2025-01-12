<?php

namespace App\Http\Controllers;

use App\Enum\UploadParseredType;
use App\Http\Requests\UploadParsered\CreateUploadParsered;
use App\Jobs\UploadParseredJob;
use App\Utils\FileUploadUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;



class UploadParseredController extends Controller
{
    function create(CreateUploadParsered $request)
    {
        $file = $request->file('file');
        $random_name_with_extension = 'public/' . FileUploadUtil::make($file);

        UploadParseredJob::dispatch(
            $random_name_with_extension,
            UploadParseredType::from($request->type),
            $request->user()
        );

        return new JsonResponse([
            'message' => 'Wait notice for upload'
        ]);
    }
}
