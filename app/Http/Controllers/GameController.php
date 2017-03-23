<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;



class GameController extends Controller
{
    
//

    /**
    * GET
    * /games/{title?}
    */
    public function scrabble($title) {
        return view('games.scrabble')->with(['title' => $title]);
    }
}
