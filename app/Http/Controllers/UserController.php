<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //Create Users
    public function register(Request $request){
        $fields=$request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|confirmed'
        ]);
        $user=User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password'])
        ]);
        $token=$user->createToken('miot')->plainTextToken;
        $response=[
            'user'=>$user,
            'token'=>$token
        ];
        return response($response,201);
    }
//Login users
    public function login(Request $request){
        $fields=$request->validate([
            'email'=>'email|required',
            'password'=>'required|'
        ]);
        //Check email in the database
        $user=User::where('email',$fields['email'])->first();
        //check password
        if(!$user || !Hash::check($fields['password'],
        $user->password)){
            return response([
                'message'=>'Invalid credentials'
            ],401);
        }
        $token=$user->createToken('miot')->plainTextToken;
        $response=[
            'user'=>$user,
            'token'=>$token
        ];
        return response($response,200);
    }

    // public function logout(){
    //     auth()->user()->tokens()->delete();
    //     return[
    //         'message'=>'Logged out'
    //     ];
    // }


    public function users(string $name){
        return User::find($name);
    }
}

