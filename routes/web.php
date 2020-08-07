<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Auth::routes();

//Social Logins
Route::get('/sign-in/github', 'AuthController@github');

Route::get('/sign-in/google', 'AuthController@google');

Route::get('/sign-in/facebook', 'AuthController@facebook');

Route::get('/sign-in/twitter', 'AuthController@twitter');

Route::get('/sign-in/github/redirect', 'AuthController@githubRedirect');

Route::get('/sign-in/google/redirect', 'AuthController@googleRedirect');

Route::get('/sign-in/facebook/redirect', 'AuthController@facebookRedirect');

Route::get('/sign-in/twitter/redirect', 'AuthController@twitterRedirect');


//Home
Route::get('/', 'HomeController@index')->name('home');

//new page in droids/users
Route::get('/droids/user/test', ['as' => 'test', function(){
    $title = "test";
    return view ('/droids/user/test', compact('title'));
}]);

//Admin
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
 //   Route::resource('/dashboard', 'AdminsController');
    Route::resource('/users', 'UsersController');
});

//Droids General
Route::namespace('Droids')->prefix('droids')->name('droids.')->group(function(){
    Route::resource('/index', 'DroidsController');

});

//Droids User
Route::namespace('Droids')->prefix('droids')->name('droid.')->group(function(){


    Route::resource('/user', 'DroidsUsersController');
    Route::post('store', 'DroidsUsersController@store');

    Route::post('updatePart', 'DroidsUsersController@updatePart')->name('updatePart');
    Route::post('assignCustomDroid', 'DroidsUsersController@assignCustomDroid')->name('assignCustomDroid');
    Route::post('populateSubMenu', 'DroidsUsersController@populateSubMenu')->name('populateSubMenu');
    Route::post('uploadImage', 'DroidsUsersController@uploadImage')->name('uploadImage');
});

//User
Route::get('admin/users/{id}/profile', 'UsersController@userProfile');
