<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Http\Requests\File\StoreFileRequest;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    public function store(StoreFileRequest $request)
    {
        $file = $request->file('file');

        $extension = $file->getClientOriginalExtension();

        $date = Carbon::now();

        $dir = 'upload/file/';
        $random_name = $dir . $date->format('Y/m/d') . '/' . random_int(1000, 9999) . time() . '.' . $extension;
        $random_name_with_extension = 'public/' . $random_name;

        Storage::makeDirectory('public/' . $dir . $date->format('Y'));
        Storage::makeDirectory('public/' . $dir . $date->format('Y/m'));
        Storage::makeDirectory('public/' . $dir . $date->format('Y/m/d'));

        $file->storeAs($random_name_with_extension);

        $data = File::create([
            'name' =>  $file->getClientOriginalName(),
            'path' => config()->get('app.url') . '/storage/' . $random_name,
            'type' => $file->getClientMimeType(),
            'user_id' => auth()->id(),
        ]);

        return new JsonResponse([
            'data' => $data
        ], 201);
    }

    public function show(int $id)
    {
        $file = File::findOrFail($id);

        return new JsonResponse([
            'data' => $file
        ]);
    }

    public function destroy(int $id)
    {
        $file = File::findOrFail($id);

        if (auth()->check() && auth()?->user()?->cannot('delete', $file)) return new JsonResponse([
            'message' => 'No access'
        ], 403);

        return new JsonResponse([
            'message' => 'Deleted'
        ]);
    }
}
