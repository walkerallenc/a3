<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;


class BookController extends Controller

{
 
    /**
    * GET /books
    */
    public function index($title = null)
    {
       return 'Here are all the Star Trek books titled '.$title;
    }


    /**
    * GET
    * /books/{title?}
    */
    public function show($title) {
        return view('books.show')->with(['title' => $title]);
    }

}
