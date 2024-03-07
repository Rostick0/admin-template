<?php

use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminRubricController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\Client\ClientPostController;
use App\Http\Controllers\Client\ClientRubricController;
use App\Http\Controllers\StorageImageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/storage/image/{path}', [StorageImageController::class, 'show']);
// Route::get('/storage/upload/image/{path}', [StorageImageController::class, 'show']);
