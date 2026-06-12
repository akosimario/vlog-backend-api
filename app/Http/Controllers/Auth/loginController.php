<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\loginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class loginController extends Controller
{
    public function authLogin(loginRequest $loginRequest){
        $validated = $loginRequest->validated();
        if(!Auth::attempt($validated)){
            return response()->json(['status'=> false, 'message'=>'wrong credentials, please try again'],401);
        }
        $user = User::where('email', $validated['email'])->first();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['status'=> true, 'message'=>'login succesfully','token' => $token],200);
    }
}
