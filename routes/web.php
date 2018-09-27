<?php

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


Route::name('change_language')->get('lang/{lang}', 'Language\ChangeLanguageController@changeLanguage');

Route::middleware('checkLanguage')->group(function () {
    Route::namespace('Front')->group(function () {
        Route::name('index')->get('/', 'Homepage\HomepageController@show'); //homepage

        // middleware for check activation user account and for check user email
        Route::middleware('checkUser')->group(function () {
            //video:
            Route::prefix('video')->namespace('Video')->name('video.')->group(function () {
                Route::name('show_without_title')->get('/{video}/', 'ShowVideoController@redirectWithTitle');
                Route::name('show')->get('/{video}/{title}', 'ShowVideoController@show')->middleware('checkPremiumVideo');
            });

            Route::middleware('auth')->group(function () {
                Route::namespace('Chat')->name('chat.')->group(function () {
                    Route::name('send_message')->post('send-message', 'SendChatMessageController@sendMessage');
                    Route::name('get_message')->post('get-chat-message', 'GetChatMessageController@getMessage');
                });
                Route::name('video_voting')->post('video-voting', 'Video\VideoVotingController@votingVideo');
            });
        });
    });
});


// ALL FOR CMS:
Route::middleware('checkAdmin')->group(function () {
    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function () {
        Route::name('index')->get('/', 'Homepage\HomepageController@listView');

        Route::prefix('videos')->namespace('Video')->name('videos.')->group(function () {
            Route::name('index')->get('/', 'ListVideoController@index');
            Route::name('edit')->get('edit/{video}', 'EditVideoController@editView');
            Route::name('update')->patch('edit/{video}', 'EditVideoController@update');
        });
    });
});


