<?php
######################################################################################################
#                                Convention Data Services - Palindrome test.                       #          
######################################################################################################
###################################################################################################### 
###The code within the routes file establishes the main route, a logs route and a debugging route.   #
###################################################################################################### 



###Route::get('/Palindrome', 'PalindromeController@index');

Route::get('/', 'PalindromeController@index');
Route::get('/tests/palindrome/{title?}', 'PalindromeController@evaluate');


if(config('app.env') == 'local') {
    Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

    Route::get('/debugbar', function() {

        Debugbar::info('Current environment: '.App::environment());
        Debugbar::error('Error!');
        Debugbar::warning('Watch out…');
        Debugbar::addMessage('Another message', 'mylabel');

        return 'Debugbar features';
    });
}

Route::get('/home', 'HomeController@index');
