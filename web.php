<?php

use Illuminate\Support\Facades\Route;
use App\Models\model\section;
use App\Models\User;
use App\Models\model;
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

Route::get('/', function (){return redirect()->route('main.index');} );

//Route::get('test',function()
//{
//    return view('test')->with('msg','hello');
//});
//Route::post('testS',function()
//{
//    return redirect()->back()->with(session()->put('session','success'));
//})->name('testS');

Route::get('/admin',function(){return view('posts.admins');});
Auth::routes();
//[App\Http\Controllers\HomeController::class, 'index']
Route::get('/home',function (){return redirect()->route('main.index');} )->name('home');

// ***********Web**********
Route::prefix('/')->group(function() {

    Route::get('main', 'App\Http\Controllers\web\main\MainController@index')->name('main.index');

    Route::get('contactUs', 'App\Http\Controllers\web\msg\MsgController@index')->name('contact.index');

    Route::post('contactUs', 'App\Http\Controllers\web\msg\MsgController@send')->name('contact.send');

    Route::get('profile', 'App\Http\Controllers\Auth\ProfileController@edit')->name('profile.edit');

    Route::post('profile', 'App\Http\Controllers\Auth\ProfileController@update')->name('profile.update');


    Route::prefix('section')->group(function (){

            Route::get('{section}','App\Http\Controllers\web\section\SectionController@index')->name('webSections.index');

    });

    Route::prefix('post')->group(function(){

        Route::get('{post}','App\Http\Controllers\web\post\PostController@index')->name('webPost.index');

        Route::post('{post}','App\Http\Controllers\web\post\PostController@comment')->name('comment.add');

        Route::get('comment/{comment}','App\Http\Controllers\web\post\PostController@edit')->name('comment.edit');

        Route::post('comment/{comment}','App\Http\Controllers\web\post\PostController@update')->name('comment.update');

        Route::get('comment/delete/{comment}','App\Http\Controllers\web\post\PostController@delete')->name('comment.delete');

    });



});

//*********Admin***********
Route::prefix('admin')->middleware('AdminPanel')->group(function (){
    Route::get('main','App\Http\Controllers\admin\main\mainController@index')->name('admin.main');

//    Section
    Route::prefix('section')->middleware('AdminRole')->group(function(){

        Route::get('/','App\Http\Controllers\admin\section\SectionController@index')->name('section.index');

        Route::get('/create','App\Http\Controllers\admin\section\SectionController@add')->name('section.create');

        Route::post('/','App\Http\Controllers\admin\section\SectionController@store')->name('section.store');

        Route::get('{section}/edit','App\Http\Controllers\admin\section\SectionController@edit')->name('section.edit');

        Route::put('{section}','App\Http\Controllers\admin\section\SectionController@update')->name('section.update');

        Route::get('delete/{section}','App\Http\Controllers\admin\section\SectionController@delete')->name('section.delete');

        Route::delete('{section}','App\Http\Controllers\admin\section\SectionController@destroy')->name('section.destroy');

    });

   //    photos
    Route::prefix('photos')->group(function(){

        Route::get('','App\Http\Controllers\admin\image\PhotoController@index')->name('photos.index');

        Route::get('create','App\Http\Controllers\admin\image\PhotoController@create')->name('photos.create');

        Route::post('','App\Http\Controllers\admin\image\PhotoController@store')->name('photos.store');

        Route::get('delete/{photo}','App\Http\Controllers\admin\image\PhotoController@delete')->name('photos.delete');

        Route::delete('{photo}','App\Http\Controllers\admin\image\PhotoController@destroy')->name('photos.destroy');

    });

//*********Posts***********
    Route::prefix('post')->group(function() {

        Route::get('/', 'App\Http\Controllers\admin\post\PostController@index')->name('posts.index');

        Route::get('create', 'App\Http\Controllers\admin\post\PostController@create')->name('posts.create');

        Route::post('store','App\Http\Controllers\admin\post\PostController@store')->name('posts.store');

        Route::get('{post}/edit', 'App\Http\Controllers\admin\post\PostController@edit')->name('posts.edit');

        Route::put('{post}', 'App\Http\Controllers\admin\post\PostController@update')->name('posts.update');

        Route::get('delete/{post}', 'App\Http\Controllers\admin\post\PostController@delete')->name('posts.delete');

        Route::delete('/{post}', 'App\Http\Controllers\admin\post\PostController@destroy')->name('posts.destroy');

    });

//*********Users**********
    Route::prefix('user')->middleware('AdminRole')->group(function(){

        Route::get('/','App\Http\Controllers\admin\user\UserController@index')->name('user.index');

        Route::get('/create','App\Http\Controllers\admin\user\UserController@add')->name('user.create');

        Route::post('/','App\Http\Controllers\admin\user\UserController@store')->name('user.store');

        Route::get('{user}/edit','App\Http\Controllers\admin\user\UserController@edit')->name('user.edit');

        Route::put('{user}','App\Http\Controllers\admin\user\UserController@update')->name('user.update');

        Route::get('delete/{user}','App\Http\Controllers\admin\user\UserController@delete')->name('user.delete');

        Route::delete('{user}','App\Http\Controllers\admin\user\UserController@destroy')->name('user.destroy');

    });

//*********Msgs***********
    Route::prefix('msg')->group(function(){

        Route::get('/{type}','App\Http\Controllers\admin\msg\MsgController@index')->name('msg.index');

        Route::get('read/{msg}','App\Http\Controllers\admin\msg\MsgController@read')->name('msg.read');

        Route::delete('delete/{msg}','App\Http\Controllers\admin\msg\MsgController@destroy')->name('msg.destroy');

    });
});























