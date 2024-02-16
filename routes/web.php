<?php

use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminRubricController;
use App\Http\Controllers\Client\ClientPostController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts', ClientPostController::class);
Route::resource('rubrics', ClientPostController::class)->only(['index', 'show']);


Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::view('', 'pages.admin.index')->name('index');
        Route::resource('posts', AdminPostController::class)->except(['show']);
        Route::resource('rubrics', AdminRubricController::class)->except(['show']);
    });
