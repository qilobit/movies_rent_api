<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\MoviesModel;

class MoviesController extends Controller
{
    
    public function all(Request $r)
    {
        $rs = null;
        
        if($r->has('title'))
        {           
            $rs = MoviesModel::where('title', 'like', '%'.$r->get('title').'%')
                    ->paginate(100);
        }else{
            $rs = MoviesModel::paginate(100);
        }

        return response()->json($rs, 200);
    }
    
    public function store(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'id'            => 'sometimes|integer',
            'title'         => 'required|string|max:200',
            'year'          => 'required|integer|max:2099',
            'imbd_rating'   => 'required|numeric',
            'poster'        => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        if ($validator->fails()) 
        {
            return response()->json([
                'status'=>'validation_error',
                'errors'=>$validator->errors()
            ], 400);
        }        
        
        $user = MoviesModel::find($r->get('id'));
        
        if(!$user)
        {
            $user = new MoviesModel();
        }
        
        if($r->has('poster'))
        {
            //delete old image on update
            $image_name = time().'.'.request()->poster->getClientOriginalExtension();
            request()->poster->move(public_path('images/movies'), $image_name);
            $user->poster = public_path('images/movies/').$image_name;              
        }
        
        $user->title        = $r->get('title');
        $user->year         = $r->get('year');
        $user->imbd_rating  = $r->get('imbd_rating');
           
        $user->save();
        
        return response(200);
        
    }
    
    public function delete($id)
    {
        try
        {
            MoviesModel::find($id)->delete();            
        }
        catch(\Exception $e)
        {
            Log::error($e->getMessage());
            return response()->json(['data'=>'Error couln not delete'], 500);
        }
        return response(200);
    }
    
    
}
