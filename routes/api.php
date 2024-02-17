<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RubricController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')
    ->name('api.')
    ->middleware('api')
    ->group(function () {

        Route::apiResource('file', FileController::class)->only(['index', 'store', 'show', 'destroy']);
        Route::apiResource('image', ImageController::class)->only(['index', 'store', 'show', 'destroy']);

        Route::apiResources([
            'posts' => PostController::class,
            'rubrics' => RubricController::class,
        ]);
    });
