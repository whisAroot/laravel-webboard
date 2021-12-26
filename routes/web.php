<?php

use App\Http\Controllers\admin\AllUserController;
use App\Http\Controllers\CRUDPostController;
use App\Http\Controllers\WebindexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WebindexController::class, 'index']);

Route::middleware(['middleware' => 'preventBack'])->group(function(){
    Auth::routes();
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin', 'middleware' => ['isAdmin','auth', 'preventBack']], function(){
    Route::get('/index', [WebindexController::class, 'index'])->name('admin.index');
    Route::get('/add/post', [CRUDPostController::class, 'CreatePost'])->name('admin.createpost');
    Route::post('/store/post', [CRUDPostController::class, 'StorePost'])->name('admin.storepost');
    Route::get('/view/post/{id}', [CRUDPostController::class, 'viewer'])->name('admin.viewpost');
    Route::post('/view/post', [CRUDPostController::class, 'CommentPost'])->name('admin.commentpost');
    Route::get('/delete/post/{id}', [CRUDPostController::class, 'DeletePost'])->name('deletepost');
});

Route::group(['prefix'=>'user', 'middleware' => ['isUser','auth', 'preventBack']], function(){
    Route::get('/index', [WebindexController::class, 'index'])->name('user.index');
    Route::get('/add/post', [CRUDPostController::class, 'CreatePost'])->name('user.createpost');
    Route::post('/store/post', [CRUDPostController::class, 'StorePost'])->name('user.storepost');
    Route::get('/view/post/{id}', [CRUDPostController::class, 'viewer'])->name('user.viewpost');
    Route::post('/view/post', [CRUDPostController::class, 'CommentPost'])->name('user.commentpost');

});