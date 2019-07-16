<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserFavoriteMoviesModel;
use Illuminate\Support\Facades\DB;

class UserFavoriteMoviesController extends Controller
{
    
    public function all(Request $r)
    {
       
        $rs = UserFavoriteMoviesModel::where('user_id', $r->get('user_id'))->get();

        return response()->json($rs, 200);
    }
    
    public function store(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'id'        => 'sometimes|integer',
            'user_id'   => 'required|exists:users,id',
            'movie_id'  => 'required|exists:movies,id'
        ]);
        
        if ($validator->fails()) 
        {
            return response()->json([
                'status'=>'validation_error',
                'errors'=>$validator->errors()
            ], 400);
        }     
        
        $exists = DB::table('user_favorite_movies')
                ->where('user_id', $r->get('user_id'))
                ->where('movie_id', $r->get('movie_id'))
                ->count();
        
        if($exists > 0)
        {
            return response()->json([
                'Movie already in favorites'
            ], 400);
        }
        
        $favorite = new UserFavoriteMoviesModel();
        
        $favorite->user_id  = $r->get('user_id');
        $favorite->movie_id = $r->get('movie_id');
           
        $favorite->save();
        
        return response(200);
        
    }
    
    public function delete($id)
    {
        try
        {
            UserFavoriteMoviesModel::find($id)->delete();            
        }
        catch(\Exception $e)
        {
            Log::error($e->getMessage());
            return response()->json(['data'=>'Error couln not delete'], 500);
        }
        return response(200);
    }
    
}
