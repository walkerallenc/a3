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

Route::get('/book/{title?}', function ($title = 'Computer') {

   return 'All books with title = '.$title;

});

Route::get('/', function () {
return 'welcome';
});


#Route::get('/book', function () {
#return 'specific book.';
#});


Route::get('/books/{title}', 'BookController@show');
#Route::get('/books/{title?}', 'BookController@index');








