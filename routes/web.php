<?php

Route::get('/', 'HomeController@index')->name('welcome');
Route::get('donate/', 'HomeController@donate')->name('donate');

Route::get('docs/', 'DocsController@showRootPage')->name('docs');
Route::get('docs/{page?}', 'DocsController@show')->name('docs.page');

Route::group(['middleware' => 'webhook'], function () {
    Route::post('webhook.json', 'WebhookController@run');
});
