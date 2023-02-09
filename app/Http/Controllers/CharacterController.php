<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Favorites_characters;
use GuzzleHttp\Client;


class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();
        $response = $client->get('https://rickandmortyapi.com/api/character');
        $characters = json_decode($response->getBody(), true);
        $characters = $characters['results'];
        return view('characters.index', ['characters' => $characters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the favorites characters.
     *
     * @return \Illuminate\Http\Response
     */
    public function favorites()
    {

        $userId = Auth::id();

        /* Get characters from DB */
        $favoritesCharacters = Favorites_characters::where('user_id', $userId)->get();
        
        /* Convert Character collection on array*/
        $charactersId = [];

        foreach ($favoritesCharacters as $character) {
            array_push($charactersId, $character['character_id']);
        }

        $charactersLenght = count($charactersId);

        /* Convert characters ID array on string */
        $charactersId = implode(',', $charactersId);

        /* Get Characters from the API*/
        $client = new Client();
 
        $response = $client->get("https://rickandmortyapi.com/api/character/$charactersId");
        $characters = json_decode($response->getBody(), true);

        return view('dashboard', ['characters' => $characters, 'charactersLenght' => $charactersLenght]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|int',
            'character_id' => 'required|int'
        ]);

        $FavaoriteCharacter = new Favorites_characters();

        $FavaoriteCharacter->user_id = $request->user_id;
        $FavaoriteCharacter->character_id = $request->character_id;

        $FavaoriteCharacter->save();

        return redirect()->route('characters');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = new Client();
        $response = $client->get("https://rickandmortyapi.com/api/character/$id");
        $character = json_decode($response->getBody(), true);
        
        return view('characters.show', ['character' => $character]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $favoriteCharacter = Favorites_characters::where('character_id',$id)->delete();

        return redirect()->route('dashboard');
    }
}
