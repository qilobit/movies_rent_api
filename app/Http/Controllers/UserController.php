<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserM;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    //
    const USER_ROLE_ADMIN = 1;
    const USER_ROLE_CLIENT = 2;
    
    
    //
    
    public function store(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'name'      => 'required|alpha|max:50',
            'lastname'  => 'required|alpha|max:50',
            'age'       => 'required|integer|min:10|max:150',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:8|regex:/[0-9]{1,}/|regex:/(@){1,}/',
            'role'      => 'required|min:1|max:2'
        ]);
        
        if ($validator->fails()) 
        {
            return response()->json([
                'status'=>'validation_error',
                'errors'=>$validator->errors()
            ], 400);
        }        
        
        $user = new UserM();
        
        $user->name     = $r->get('name');
        $user->lastname = $r->get('lastname');
        $user->age      = $r->get('age');
        $user->email    = $r->get('email');
        $user->password = Hash::make($r->get('password'));
        $user->role     = $r->get('role');
        
        $user->save();
        
        return response(201);
        
    }
    
    public function auth(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'email'     => 'required|email',
            'password'  => 'required|string|max:50',
        ]);
        
        if ($validator->fails()) 
        {
            return response()->json([
                'status'=>'validation_error',
                'errors'=>$validator->errors()
            ], 401);
        }  
        
        $user = UserM::where('email', $r->get('email'))->first();

        if(!$user)
        {
            return response()->json([
                'data'  =>'User not found'  
            ], 403);    
        }
        
        if(Hash::check($r->get('password'), $user->password))
        {
            
            try 
            {
                $token = JWTAuth::fromUser($user);
            } 
            catch (JWTException $e) 
            {
                log::error($e->getMessage());
                return response()->json(['error' => 'could_not_create_token'], 500);
            }
            
            return response()->json([
                'token' =>  $token
            ], 200);
        }
        else
        {
            return response()->json([
                'data'  =>'Invalid credentials'  
            ], 400);
        }
        
    }
    
}
