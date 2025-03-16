<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function search(Request $request) {
        $response = Http::get('https://www.omdbapi.com/', [
            'apikey' => env('OMDB_API_KEY'),
            's' => $request->input('query')
        ]);
        return $response->json();
    }

    public function add(Request $request) {
        return Auth::user()->movies()->create([
            'imdb_id' => $request->imdb_id,
            'pinned' => false,
        ]);
    }

    public function watchlist() {
        return Auth::user()->movies()->orderBy('pinned', 'desc')->latest()->paginate(10);
    }

    public function destroy(Movie $movie) {
        $movie->delete();
        return response()->json(['status' => 'Deleted']);
    }

    public function pin(Movie $movie) {
        $movie->update(['pinned' => !$movie->pinned]);
        return response()->json(['status' => 'Updated', 'pinned' => $movie->pinned]);
    }
}
