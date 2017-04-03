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

Route::get('/books/new', 'BookController@createNewBook');
Route::post('/books/new', 'BookController@storeNewBook');
                                          
#Route::get('/book/{title?}', function ($title = 'Computer') {
#
#   return 'All books with title = '.$title;
#
#});

Route::get('/', function () {
return 'Welcome to Allens Scrabble Word Game';
});

Route::get('/books/search', 'BookController@search');

#Route::get('/books/{title?}', 'BookController@index');
Route::get('/books/{title}', 'BookController@show');
###Route::get('/games/{title}', 'GameController@scrabble');

Route::get('/games/{title}', 'WordValueCalculatorController@scrabble');


Route::get('/debugbar', function() {

    $data = Array('foo' => 'bar');
    Debugbar::info($data);
    Debugbar::info('Current environment: '.App::environment());
    Debugbar::error('Error!');
    Debugbar::warning('Watch out…');
    Debugbar::addMessage('Another message', 'mylabel');

    return 'Just demoing some of the features of Debugbar';

});

if(config('app.env') == 'local') {
    Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
}



