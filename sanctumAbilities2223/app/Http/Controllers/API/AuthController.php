<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $auth = Auth::user();
            $success['token'] =  $auth->createToken('token_acceso',["delete","create","otracosa"])->plainTextToken;
            $success['name'] =  $auth->name;
            return response()->json(["success"=>true,"data"=>$success, "message" => "Logged in!"],200);
        }
        else{
            return response()->json(["success"=>false, "message" => "Unauthorised"],202);
        }
    }


    public function register(Request $request)
    {

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);  //También vale: Hash::make($request->password)
        $user = User::create($input);
        $success['token']  = $user->createToken('nuevo')->plainTextToken;
        $success['name'] =  $user->name;

        return response()->json(["success"=>true,"data"=>$success, "message" => "User successfully registered!"],200);
    }

    public function logout(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $cantidad = Auth::user()->tokens()->delete();
            return response()->json(["success"=>$cantidad, "message" => "Tokens Revoked"],200);
        }
        else {
            return response()->json("Unauthorised",204);
        }

    }
}
