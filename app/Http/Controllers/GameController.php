<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;



class GameController extends Controller
{
    
/**************************************************************
* GET
* /scrabble
***************************************************************/
public function scrabble(Request $request) {

    # Start with an empty array of search results; books that
    # match our search query will get added to this array

    $this->validate($request, [
    'enteredWord' => 'required|alpha|min:3|max:10',
    ]);

    $searchResults = [];
    $searchTermArray = [];

    # Store the searchTerm in a variable for easy access
    # The second parameter (null) is what the variable
    # will be set to *if* searchTerm is not in the request.
    
    $enteredWord = $request->input('enteredWord', null);
    $includeBingo = $request->input('includeBingo', null); 

######dump($request); 
######dump($enteredWord); 
######dump($includeBingo); 

    # Only try and search *if* there's a searchTerm
    if($enteredWord) {

######dump($searchTerm); 
           $searchTermArray = str_split($enteredWord);
######dump($searchTermArray); 
           ###loop through $searchTermArray letter by letter###
           $total=0;
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
#           # Loop through all the letters data, looking for matches
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
######                    dump($searchTermItem);
######                    dump($letter);
######                    dump($match);

                    $searchResults[$alphabetitem] = $letter;
######                    dump($searchResults[$alphabetitem]); 
                    $total = $total+(1*$searchResults[$alphabetitem]);
######                    dump($total);
                }
           }
        }

######         dump($total);
######dump($request->has('multipliercheck'));
######dump($request->has('includeBingo'));

         #if($request->input('multipliercheck')=='single'){
         #            dump($total);
         #}
         if($request->input('multipliercheck')=='double'){
                     $total=2*$total;
         }
         if($request->input('multipliercheck')=='triple'){
                     $total=3*$total;
         }
         if($request->input('includeBingo')==true){
                     $total=50+$total;
         }
    } #Loop through enteredWord array 

    return view('games.scrabble')->with([
        'enteredWord' => $enteredWord, 
        'total' => $total,
        'multipliercheck' => $request->input('multipliercheck'), 
        'includeBingo' => $request->has('includeBingo')
    ]);
     
} # if($enteredWord)


}
