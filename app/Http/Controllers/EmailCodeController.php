<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailCode\StoreEmailCodeRequest;
use App\Mail\AuthCode;
use App\Models\EmailCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailCodeController extends Controller
{
    public function store(StoreEmailCodeRequest $request)
    {
        EmailCode::where('email', $request->email)->delete();

        $code = sprintf('%06d', rand(1, 1000000));

        EmailCode::create([
            'email' => $request->email,
            'code' => $code,
        ]);

        Mail::to($request->email)->send(new AuthCode($code));

        return new JsonResponse([
            'message' => 'created'
        ]);
    }
}
