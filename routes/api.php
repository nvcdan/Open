<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getNotifications/{id}', ['as' => 'api.notifications', 'uses' => 'API\NotificationController@getNotifications']);
Route::get('markNotification/{id}', ['as' => 'api.mark.notification', 'uses' => 'API\NotificationController@markNotificationRead']);
Route::get('settingsData/{id}', ['as' => 'api.settings', 'uses' => 'API\SettingsController@getUserData']);
Route::patch('settingsUpdate/{id}', ['as' => 'api.update.settings', 'uses' => 'API\SettingsController@updateUserData']);