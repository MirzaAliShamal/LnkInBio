<?php

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


require __DIR__.'/auth.php';


Route::get('/{username?}', 'HomeController@home')->name('home');


// Miscellaneous Ajax Routes
Route::prefix('ajax')->group(function() {
    Route::get('/validate-username', 'AjaxController@validateUsername')->name('validate.username');
    Route::get('/username-exists', 'AjaxController@usernameExists')->name('username.exists');
    Route::get('/email-exists', 'AjaxController@emailExists')->name('email.exists');
    Route::get('/delete-box','AjaxController@deleteBox')->name('actionBox.delete');
    Route::get('/delete-link/{id?}','AjaxController@deletelink')->name('delete.link');
    Route::get('/add-thumbnail-box','AjaxController@addThumbnailBox')->name('actionBox.addThumbnail');
    Route::get('/leap-link-box','AjaxController@leapLinkBox')->name('actionBox.leapLink');
    Route::get('/link-analytics-box','AjaxController@linkAnalyticsBox')->name('actionBox.linkAnalytics');
    Route::get('/priority-link-box','AjaxController@priorityLinkBox')->name('actionBox.priorityLink');
    Route::get('/Schedule-link-box','AjaxController@scheduleLinkBox')->name('actionBox.scheduleLink');
});

Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function() {

    Route::prefix('links')->name('link.')->group(function() {
        Route::get('/', 'LinkController@links')->name('list');
        Route::get('/new', 'LinkController@new')->name('new');
        Route::post('/save', 'LinkController@save')->name('save');
    });

});
