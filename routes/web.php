<?php

Route::get('/', 'HomeController@index');

Route::get('docs/', 'DocsController@showRootPage');
Route::get('docs/{page?}', 'DocsController@show');

Route::group(['middleware' => 'webhook'], function () {
    Route::post('webhook.json', 'WebhookController@run');
});
