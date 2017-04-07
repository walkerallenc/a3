<?php
######################################################################################################
#                                DWA15-Dynamic Web Applications Assignment #3.                       #          
######################################################################################################
###################################################################################################### 
###The code within the routes file establishes the main route, a logs route and a debugging route.   #
###################################################################################################### 

Route::get('/games/scrabble/{title?}', 'GameController@scrabble');

if(config('app.env') == 'local') {
    Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

    Route::get('/debugbar', function() {

        $data = Array('scrabbleword' => 'value');
        Debugbar::info($data);
        Debugbar::info('Current environment: '.App::environment());
        Debugbar::error('Error!');
        Debugbar::warning('Watch out…');
        Debugbar::addMessage('Another message', 'mylabel');

        return 'Debugbar features';
    });
}



