<?php


######################################################################################################
#                                DWA15-Dynamic Web Applications Assignment #3.                       #          
######################################################################################################

namespace App\Http\Controllers;



use Illuminate\Http\Request;



class GameController extends Controller
{
 

public function index(Request $request) {

    $enteredWord = $request->input('enteredWord', null);
    $total=0;

    return view('games.scrabble')->with([
        'enteredWord' => $enteredWord, 
        'total' => $total,
        'multipliercheck' => $request->input('multipliercheck'), 
        'includeBingo' => $request->has('includeBingo')
        ]);
}

##############################################################################################################
#This is the scrabble word value calculation function.
##############################################################################################################
public function scrabble(Request $request) {

##############################################################################################################
#This step validates the scrabble word that is entered 
#The word is required, is made of letters, is at least 3 characters long and no more than 10 characters long.
##############################################################################################################
    $this->validate($request, [
    'enteredWord' => 'required|alpha|min:3|max:10',
    ]);

    $searchResults = [];
    $searchTermArray = [];

    # Store the searchTerm in a variable for easy access
    # The second parameter (null) is what the variable
    # will be set to *if* searchTerm is not in the request.

##############################################################################################################
#This step obtains the validated "enteredWord" and stores the value.                                         # 
##############################################################################################################
    $enteredWord = $request->input('enteredWord', null);
#    $includeBingo = $request->input('includeBingo', null); 

##############################################################################################################
#This "if" condition is stepped into only if "$enteredWord" has a value.                                     #
##############################################################################################################
    if($enteredWord) {

           $searchTermArray = str_split($enteredWord);
           $total=0;
           foreach($searchTermArray as $searchTermArrayItem => $searchTermItem) {
               $lettervaluesRawData = file_get_contents(database_path().'/lettervalues.json');
               $letters = json_decode($lettervaluesRawData, true);
               ######################################################################## 
               ###loop through $searchTermArray letter by letter looking for matches  #
               ######################################################################## 
               foreach($letters as $alphabetitem => $letter) {
                   $match = strtolower($alphabetitem) == strtolower($searchTermItem);
                   ####################################################################################### 
                   ###If a letter from the scrabble word that was entered is found in the letters array, #
                   ###its value  is captured and added to an accumulator variable "$total".              #  
                   ####################################################################################### 
                   if($match) {
                       $searchResults[$alphabetitem] = $letter;
                       $total = $total+$searchResults[$alphabetitem];
                }
            }
        }

        #################################################################################### 
        ###The scrabble word multpliers and bonus points are calculated in the next steps. #
        #################################################################################### 
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

    ######################################################################################  
    ###The step supplies the form values and calculated scrabble word value to the view. #
    ###################################################################################### 
    return view('games.scrabble')->with([
        'enteredWord' => $enteredWord, 
        'total' => $total,
        'multipliercheck' => $request->input('multipliercheck'), 
        'includeBingo' => $request->has('includeBingo')
        ]);
     
    } # if($enteredWord)
}
