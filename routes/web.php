<?php

use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminRubricController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\Client\ClientPostController;
use App\Http\Controllers\Client\ClientRubricController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::view('{any?}', 'app')->where('any', '.*');
Route::view('', 'app');
// Route::get('', AppController::class);
// Route::get('{any?}', [AppController::class, 'get'])->where('any', '.*');

// Route::resource('posts', ClientPostController::class);
// Route::resource('rubrics', ClientRubricController::class)->only(['index', 'show']);


// Route::prefix('admin')
//     ->name('admin.')
//     ->group(function () {
//         Route::view('', 'pages.admin.index')->name('index');
//         Route::resource('posts', AdminPostController::class)->except(['show']);
//         Route::resource('rubrics', AdminRubricController::class)->except(['show']);
//     });
