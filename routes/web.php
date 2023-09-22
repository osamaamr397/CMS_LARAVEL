<?php

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


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/post/{post}', [App\Http\Controllers\PostController::class,'show'])->name('post');

/*
 * same thing
 * Route::get('/admin',AdminsController@index)->name('admin.index');
 * */

Route::middleware('auth')->group(function (){
    Route::get('/admin',[App\Http\Controllers\AdminsController::class,'index'])->name('admin.index');
    Route::get('/admin/posts/',[App\Http\Controllers\PostController::class,'index'])->name('post.index');
    Route::get('/admin/posts/create',[App\Http\Controllers\PostController::class,'create'])->name('post.create');
    Route::post('/admin/posts/store',[App\Http\Controllers\PostController::class,'store'])->name('post.store');
    Route::delete('/admin/posts/{post}/destroy',[App\Http\Controllers\PostController::class,'destroy'])->name('post.destroy');
    Route::patch('/admin/posts/{post}/update',[App\Http\Controllers\PostController::class,'update'])->name('post.update');


    Route::get('admin/users/{user}/profile',[App\Http\Controllers\UserController::class,'show'])->name('user.profile.show');
    Route::put('admin/users/{user}/update',[App\Http\Controllers\UserController::class,'update'])->name('user.profile.update');
    Route::delete('admin/users/{user}/destroy',[App\Http\Controllers\UserController::class,'destroy'])->name('users.destroy');

});
Route::get('/admin/posts/{post}/edit',[App\Http\Controllers\PostController::class,'edit'])->middleware('can:view,post')->name('post.edit');

Route::group(['middleware' => ['auth']], function() {
    /**
     * Logout Route
     */
    Route::get('/logout', [App\Http\Controllers\LogoutController::class,'perform'])->name('logout.perform');
});

Route::middleware('role:admin')->group(function (){

    Route::get('admin/users',[App\Http\Controllers\UserController::class,'index'])->name('users.index');

});
