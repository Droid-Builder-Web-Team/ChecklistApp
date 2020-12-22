<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewDroid;
use App\User;

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

Auth::routes(['verify' => true]);

//Social Logins
Route::get('/sign-in/github', 'AuthController@github');

Route::get('/sign-in/google', 'AuthController@google');

Route::get('/sign-in/facebook', 'AuthController@facebook');

Route::get('/sign-in/twitter', 'AuthController@twitter');

Route::get('/sign-in/github/redirect', 'AuthController@githubRedirect');

Route::get('/sign-in/google/redirect', 'AuthController@googleRedirect');

Route::get('/sign-in/facebook/redirect', 'AuthController@facebookRedirect');

Route::get('/sign-in/twitter/redirect', 'AuthController@twitterRedirect');

Route::group(['middleware' => ['verified', 'auth', 'gdpr.terms']], function ()
{
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('getting_started', 'HomeController@tutorial')->name('getting_started');
    Route::get('about', 'HomeController@about')->name('about');
    Route::get('contact', 'HomeController@contact')->name('contact');

    // Admin
    Route::group(["namespace" => "Admin"], function ()
    {
        Route::post('avatar', 'UserProfileController@UploadAvatar');
            Route::resource('droids/admin', 'DroidsAdminController');
        Route::get('admin/users/{id}/profile', 'UserProfileController@show')->name('admin.users.profile');
        Route::post('admin/users/{id}/profile', 'UserProfileController@update')->name('admin.users.profile.update');
        Route::get('admin/users/{id}/notifications', 'UsersController@notify')->name('admin.users.notifications');
        Route::delete('admin/users/{id}/destroy', 'UsersController@destroy')->name('delete.user');
        Route::get('admin/users/{id}/show', 'UsersController@show')->name('admin.users.show');
        Route::prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function ()
        {
            Route::get('/dashboard', 'DashboardController')->name('admin.dashboard');

            Route::resource('/users', 'UsersController');
            Route::get('/dashboard/userstable', 'UserApiController@getUsersTable');
            Route::get('/dashboard/droidstable', 'DroidApiController@getDroidsTable');
        });
    });
    Route::get('/designer/dashboard', 'Admin\DashboardController')->name('designer.dashboard');
    Route::get('/designer/dashboard/user-image', 'Admin\DashboardController@upload')->name('userImageUpload');
    Route::post('uploadImage', 'Admin\DashboardController@uploadImage')->name('uploadImage');



    //Droids General
    Route::namespace('Droids')->prefix('droids')->name('droids.')->group(function ()
    {
        Route::get('buildprogress/{id}', 'DroidsUsersController@getDroidProgress');
        Route::patch('buildprogress/{id}', 'DroidsUsersController@updatePart');
        Route::post('buildprogress/{id}/completeall/{section}', 'DroidsUsersController@completeAllSubsection');
        Route::post('buildprogress/{id}/naall/{section}', 'DroidsUsersController@naAllSubsection');
        Route::resource('/index', 'DroidsController');
        Route::resource('/add', 'DroidsController@create');
        Route::get('/autocomplete', 'DroidsController@autocomplete')->name('autocomplete');
    });

    //Droids User
    Route::namespace ('Droids')->prefix('droids')->name('droid.')->group(function ()
    {
        Route::resource('/user', 'DroidsUsersController');
        Route::post('store', 'DroidsUsersController@store');
        Route::post('updatePart', 'DroidsUsersController@updatePart')->name('updatePart');
        Route::post('assignCustomDroid', 'DroidsUsersController@assignCustomDroid')->name('assignCustomDroid');
        Route::post('populateSubMenu', 'DroidsUsersController@populateSubMenu')->name('populateSubMenu');
        Route::post('uploadImage', 'DroidsUsersController@uploadImage')->name('uploadImage');
        Route::post('selectPart', 'DroidsUsersController@selectPart')->name('selectPart');
        Route::post('NAPart', 'DroidsUsersController@NAPart')->name('NAPart');

    });
});

//Notifications
// Route::get('/notify', function ()
// {
//     $user = \App\User::find(1);

//     $details = [
//         'greeting' => 'Hey There!',
//         'body' => 'Just so you know, a new droid has been released which means there is a new checklist available! You can view it here ',
//         'thanks' => 'Happy Printing, May the Force Be With You!',
//         'unsubscribe' => 'Don\'t want to be notified about new droids? Unsubscribe Here.',
//     ];
//     $user->notify(new \App\Notifications\NewDroid($details));

//     return dd("done");
// });
