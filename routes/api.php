<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatUserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EmailCodeController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\OrderingController;
use App\Http\Controllers\OrderingProductController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDatePriceController;
use App\Http\Controllers\PropertyCategoryController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\PropertyValueController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RubricController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\StatisticDayController;
use App\Http\Controllers\UploaderController;
use App\Http\Controllers\UploadParseredController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserStatisticController;
use App\Http\Controllers\VendorController;
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

Route::prefix('v1')
    ->name('api.')
    ->middleware('api')
    ->group(function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:300,1');
            Route::post('/register', [AuthController::class, 'register']);

            // 'middleware' => 'jwt'
            Route::group(['middleware' => 'jwt'], function () {
                Route::post('/logout', [AuthController::class, 'logout']);
                Route::post('/refresh', [AuthController::class, 'refresh']);
                Route::get('/me', [AuthController::class, 'me']);
            });
        });

        Route::apiResource('file', FileController::class)->only(['index', 'store', 'show', 'destroy']);
        Route::apiResource('image', ImageController::class)->only(['index', 'store', 'show', 'destroy']);

        Route::get('/statistic-days', [StatisticDayController::class, 'index']);
        Route::post('/statistic-days/increment', [StatisticDayController::class, 'increment']);

        Route::apiResource('/chats', ChatController::class)->only(['index', 'store', 'show']);
        Route::apiResource('/chat-users', ChatUserController::class)->except(['index', 'store']);

        Route::get('/uploader/download', [UploaderController::class, 'download']);
        Route::post('/uploader/upload', [UploaderController::class, 'upload']);

        Route::get('/messages/read/{id}', [MessageController::class, 'read']);

        Route::get('/product-date-prices', [ProductDatePriceController::class, 'index']);

        Route::apiResource('/ordering-products', OrderingProductController::class)->only(['index']);

        Route::get('/reviews/product/{id}', [ReviewController::class, 'showByProductId']);

        Route::apiResource('/user-statistics', UserStatisticController::class)->only(['index']);
        Route::get('/user-statistics/orderings', [UserStatisticController::class, 'orderings']);

        Route::patch('/users/email-update', [UserController::class, 'updateEmail']);

        Route::get('/notices', [NoticeController::class, 'index']);
        Route::patch('/notices/all/read', [NoticeController::class, 'readAll']);
        Route::patch('/notices/{id}/read', [NoticeController::class, 'read']);

        Route::apiResource('/email-code', EmailCodeController::class)->only(['store']);

        Route::post('/upload/parsered', [UploadParseredController::class, 'create']);

        Route::apiResources([
            'posts' => PostController::class,
            'rubrics' => RubricController::class,
            'vendors' => VendorController::class,
            'categories' => CategoryController::class,
            'products' => ProductController::class,
            'orderings' => OrderingController::class,
            'properties' => PropertyController::class,
            'property_types' => PropertyTypeController::class,
            'property_categories' => PropertyCategoryController::class,
            // 'property_values' => PropertyValueController::class,
            'reviews' => ReviewController::class,
            'comments' => CommentController::class,
            'messages' => MessageController::class,
            'slides' => SlideController::class,
        ]);
    });
