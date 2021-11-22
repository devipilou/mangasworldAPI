<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Genre;


class GenreController extends Controller
{
    /**
     * Afficher les genres dans une liste déroulante
     * @return Vue formGenre
     */
    public function index() {
        $genres = Genre::all();
        return response()->json($genres,200);
    }  
    
    public function getMangasGenre($id) {
        $genre = Genre::find($id);
        $mangas = $genre->mangas;
        return response()->json($mangas, 200);
    }
}

