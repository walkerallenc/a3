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
#This is the palindrome evaluation function.
##############################################################################################################
public function evaluate(Request $request) {

##############################################################################################################
#This step validates the string that is entered 
#The word is required, is made of letters, is at least 1 character long.
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
#This step obtains the validated "enteredWord", removes spaces and stores the value.                                         # 
##############################################################################################################
    $enteredWord = $request->input('enteredWord', null);
    $cleanedenteredWord = str_replace(' ','',$enteredWord);
##############################################################################################################
#This "if" condition is stepped into only if "$enteredWord" has a value.   
#The string contents order are reversed using the array_reverse function and are stored as an array.
#While being processed in a foreach loop character by character, spaces are removed from the original string and
#reassembled in a WordAccumulator string variable.  The reveresed ordered and original ordered are then compared.
#If the 2 strings are equal to each other, it is deterined that it is a palindrome. If not equal, they are 
#not considered a palindrome.                                  
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

    } 

    ###############################################################################################  
    ###The step supplies the enteredWord, WordAccumulator and palindromeresults values to the view. 
    ############################################################################################### 
    return view('tests.palindrome')->with([
        'enteredWord' => strtolower($enteredWord), 
        'WordAccumulator' => strtolower($WordAccumulator), 
        'palindromeresults' => $palindromeresults
        ]);
     
    } # if($enteredWord)
}
