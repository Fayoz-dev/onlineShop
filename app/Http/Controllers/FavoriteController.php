<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth:sanctum');
    }

    public function index()
    {
        return auth()->user()->favorites()->paginate(20);
    }

    public function store(Request $request)
    {
         auth()->user()->favorites()->attach($request->product_id);

         return response()->json([
            'success' => true,
            'message' => 'add favorites success'
         ]);
    }

    public function destroy($favorite_id)
    {
       if (auth()->user()->hasFavorite($favorite_id)){
           auth()->user()->favorites()->detach($favorite_id);

           return response()->json(['success' => true, 'message' => 'Deleted success !']);
       }

       return response()->json(['success' => false, 'message' => 'No favorite']);
    }
}
