<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\PostTopicController;
use App\Http\Controllers\Api\PostReportController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SubscribeController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ImageController;
use App\Models\PostReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

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
Route::apiResource('/like', LikeController::class);
Route::resource('/follow',SubscribeController::class);
Route::get('/page/{user}', [HomeController::class, 'showPage']);

Route::get('/page/{user}/post', [HomeController::class, 'showPost']);
Route::get('/like/post/{post}', [LikeController::class, 'showLike']);
Route::get('/likeStatus/post/{post}', [LikeController::class, 'likeStatus']);
Route::post('/like/post/{post}', [LikeController::class, 'like']);
Route::get('/unlike/post/{post}', [LikeController::class, 'unlike']);


Route::post('/favorite/post/{post}', [FavoriteController::class, 'favorite']);



Route::get('/page/subscribe/{user}',[SubscribeController::class,'showFollow']);
Route::post('/page/subscribe/{user}',[SubscribeController::class,'subscribe']);
Route::get('/page/unfollow/{user}',[SubscribeController::class,'unfollow']);
Route::get('/page/sub/{user}',[SubscribeController::class,'sub']);
Route::post('/likeTotal',[LikeController::class,'getLikeTotal']);
Route::post('/reportPost/post/{post}', [PostReportController::class, 'reportPost']);
Route::post('/comments', [CommentController::class, 'comments']);
Route::post('/comments/post/{post}', [CommentController::class, 'showComments']);
Route::post('/users',[UserController::class, 'showUser']);
Route::post('/user/name',[UserController::class, 'userShowName']);
// Route::resource('/',SubscribeController::class);

Route::get('/topic/{post}', [PostTopicController::class, 'postTag']);
Route::get('/topic/tag/{topic}', [PostTopicController::class, 'topic']);

Route::get('/images/{filename}', 'ImageController@getImage')->name('image.show');
Route::get('/images/{filename}', [ImageController::class, 'getImage'])->name('image.show');
Route::get('/admin/reported-posts', [PostReportController::class, 'getReportedPosts']);
Route::delete('/admin/delete-post/{post}', [AdminController::class, 'deletePost']);
Route::post('/admin/suspend-user/{user}', [AdminController::class, 'suspendUser']);
Route::get('/images/{filename}', [ImageController::class, 'getImage'])->name('image.show');
Route::apiResource('/register',AuthController::class);

Route::post('/auth/register', [AuthController::class, 'register']);

Route::get('/page/{user}/post', [HomeController::class, 'showPost']);

Route::post('/profile/edit', [ProfileController::class, 'update']);

Route::post('/countPost', [PostController::class, "countPost"]);
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
    Route::post('/auth/register', [AuthController::class, 'register']);

});
