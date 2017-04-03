<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WordValueCalculatorController extends Controller
{
    //


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

/**************************************************************
* GET
* /search
***************************************************************/
#public function search(Request $request) {
#
#        # ======== Temporary code to explore $request ==========
#
#        # See all the properties and methods available in the $request object
#        dump($request);
#
#        # See just the form data from the $request object
#        dump($request->all());
#
#        # See just the form data for a specific input, in this case a text input
#        dump($request->input('searchTerm'));
#
#        # See what the form data looks like for a checkbox
#        dump($request->input('caseSensitive'));
#
#        # Boolean to see if the request contains data for a particular field
#        dump($request->has('searchTerm')) # Should be true
#        dump($request->has('publishedYear')) # There's no publishedYear input, so this should be false
#
#        # You can get more information about a request than just the data of the form, for example...
#        dump($request->fullUrl());
#        dump($request->method());
#        dump($request->isMethod('post'));
#
#        # ======== End exploration of $request ==========
#
#        # Return the view with some placeholder data we'll flesh out in a later step
#
#        return view('books.search')->with([
#            'searchTerm' => '',
#            'caseSensitive' => false,
#            'searchResults' => []
#        ]);
#
#    }

/**************************************************************
* GET
* /search
***************************************************************/
public function scrabble(Request $request) {

    # Start with an empty array of search results; books that
    # match our search query will get added to this array
    $searchResults = [];
    $searchTermArray = [];

    # Store the searchTerm in a variable for easy access
    # The second parameter (null) is what the variable
    # will be set to *if* searchTerm is not in the request.
    $searchTerm = $request->input('searchTerm', 'mashpee');
#    $searchTerm = $request->input('searchTerm', null);

#dump($searchTerm); 

    # Only try and search *if* there's a searchTerm
    if($searchTerm) {

#dump($searchTerm); 
           $searchTermArray = str_split($searchTerm);
######dump($searchTermArray); 
            ###loop through $searchTermArray letter by letter###
           foreach($searchTermArray as $searchTermArrayItem => $searchTermItem) {
#
#            # Open the lettervalues.json data file
#            # database_path() is a Laravel helper to get the path to the database folder
#            # See https://laravel.com/docs/5.4/helpers for other path related helpers
            $lettervaluesRawData = file_get_contents(database_path().'/lettervalues.json');
######             dump($lettervaluesRawData);
#
#            # Decode the book JSON data into an array
#            # Nothing fancy here; just a built in PHP method
            $letters = json_decode($lettervaluesRawData, true);
#
#            # Loop through all the letters data, looking for matches
            foreach($letters as $alphabetitem => $letter) {
######                dump($alphabetitem);
#
#                # Case sensitive boolean check for a match
#                if($request->has('caseSensitive')) {
#                    $match = $alphabetitem == $searchTerm;
#                }
#                # Case insensitive boolean check for a match
#                else {
                    $match = strtolower($alphabetitem) == strtolower($searchTermItem);
######                    dump($searchTermItem);
######                    dump($letter);
######                    dump($match);
#                }
#
#                # If it was a match, add it to our results
                if($match) {
                    dump($searchTermItem);
                    dump($letter);
                    dump($match);



                    $searchResults[$alphabetitem] = $letter;
                    dump($searchResults[$alphabetitem]); 
                    $total = (1500*$searchResults[$alphabetitem]);
                    dump($total);
                }
            }
        }
#
#        # Return the view, with the searchTerm *and* searchResults (if any)
#        return view('books.search')->with([
#            'searchTerm' => $dump($searchTermArray),
#            'caseSensitive' => $request->has('caseSensitive'),
#            'searchResults' => $searchResults
#        ]);
    } #Loop through searchterm array      
} # if($searchTerm)

/**************************************************************
* GET
* /books/new
* Display the form to add a new book
***************************************************************/
public function createNewBook(Request $request) {
    return view('books.new');
}


/**
* POST
* /books/new
* Process the form for adding a new book
*/
#public function storeNewBook(Request $request) {
#
#    $title = $request->input('title');
#
#    # 
#    #
#    # [...Code will eventually go here to actually save this book to a database...]
#    #
#    #
#
#    # Redirect the user to the page to view the book
#    return redirect('/books/'.$title);
#}


## Validating the request
#Below is a basic validation example where we validate that the incoming `title` for a new book is a) not blank and b) at least three characters long:

public function storeNewBook(Request $request) {
        # Validate the request data
        $this->validate($request, [
            'title' => 'required|min:3|max:10',
        ]);

        # Note: If validation fails, it will redirect the visitor back to the form page
        # and none of the code that follows will execute.
        $title = $request->input('title');

        # 
        #
        # [...Code will eventually go here to actually save this book to a database...]
        #
        #

        # Redirect the user to the page to view the book
        return redirect('/books/'.$title);
    }

}
