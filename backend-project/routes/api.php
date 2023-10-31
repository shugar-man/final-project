<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\SubscribeController;
use App\Http\Controllers\ApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/',function() {
    return ['hello'=>'world'];
})->name('i sea tel');


Route::apiResource('/post',PostController::class);
Route::apiResource('/', HomeController::class);
Route::get('/page/{user}', [HomeController::class, 'showPage']);
// Route::resource('/',SubscribeController::class);
Route::get('/page/{user}/post', [HomeController::class, 'showPost']);
Route::post('/like/post/{post}', [LikeController::class, 'like']);
// Route::resource('/',SubscribeController::class);


// Route::get('/',
//     [PostController::class, 'showPage']
// )->name('post');
Route::get('/posts/good',
    [PostController::class, 'good']
)->name('post.good');
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);
    Route::post('register', [AuthController::class, 'register']);

});