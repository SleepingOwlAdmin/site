<?php

/**
 * Convert some text to Markdown...
 */
function markdown($text)
{
    return (new ParsedownExtra)->text($text);
}


//Route::get('/', function () {
//    return view('marketing');
//});

Route::get('', 'DocsController@showRootPage');
Route::get('docs/{page?}', 'DocsController@show');

Route::group(['middleware' => 'webhook'], function () {
    Route::post('webhook.json', 'WebhookController@run');
});
