<?php


######################################################################################################
#                                Convention Data Services - Palindrome Test.                         #          
######################################################################################################

namespace App\Http\Controllers;



use Illuminate\Http\Request;



class PalindromeController extends Controller
{
 

public function index(Request $request) {

    $enteredWord = $request->input('enteredWord', null);
    
    $cleanedenteredWord = str_replace(' ','',$enteredWord);
    $enteredWord = str_replace(' ','',$enteredWord);
    
    $total=0;

    return view('tests.palindrome')->with([
        'enteredWord' => $enteredWord
#        'WordAccumulator' => $WordAccumulator, 
        ]);
}

##############################################################################################################
#This is the scrabble word value calculation function.
##############################################################################################################
public function evaluate(Request $request) {

##############################################################################################################
#This step validates the scrabble word that is entered 
#The word is required, is made of letters, is at least 3 characters long and no more than 10 characters long.
##############################################################################################################
    $this->validate($request, [
    'enteredWord' => 'required',
    ]);
#    'enteredWord' => 'required|alpha_num|min:1',

    $searchResults = [];
    $searchTermArray = [];

    # Store the searchTerm in a variable for easy access
    # The second parameter (null) is what the variable
    # will be set to *if* searchTerm is not in the request.

##############################################################################################################
#This step obtains the validated "enteredWord" and stores the value.                                         # 
##############################################################################################################
    $enteredWord = $request->input('enteredWord', null);
    $cleanedenteredWord = str_replace(' ','',$enteredWord);
##############################################################################################################
#This "if" condition is stepped into only if "$enteredWord" has a value.                                     #
##############################################################################################################
    if($enteredWord) {

           $searchTermArray=array_reverse(str_split($enteredWord));

           $WordAccumulator="";

           $total=0;
           foreach($searchTermArray as $searchTermArrayIndex => $searchTermItem) {

                   $good = $searchTermItem != "";
                   if($good) {
                       $searchResults[$searchTermArrayIndex] = $searchTermItem;
                       $WordAccumulator=$WordAccumulator.$searchResults[$searchTermArrayIndex];
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
#dump($enteredWord);
#dump($cleanedenteredWord);
#dump($WordAccumulator);

$WordAccumulator = str_replace(' ','',$WordAccumulator);

$palindromeresults="";
if(strtolower($cleanedenteredWord)==strtolower($WordAccumulator))
      {      
          $palindromeresults="This is a palindrome.";          
      }
else
      {
          $palindromeresults="This is not a palindrome.";          
      }

    } #Loop through enteredWord array 

    ######################################################################################  
    ###The step supplies the form values and calculated scrabble word value to the view. #
    ###################################################################################### 
    return view('tests.palindrome')->with([
        'enteredWord' => strtolower($enteredWord), 
        'WordAccumulator' => strtolower($WordAccumulator), 
        'palindromeresults' => $palindromeresults
        ]);
     
    } # if($enteredWord)
}
