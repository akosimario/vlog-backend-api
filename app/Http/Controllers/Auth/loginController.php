<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\loginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthService;

class loginController extends Controller
{
    protected AuthService $authService;
    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }
    public function authLogin(loginRequest $loginRequest){
       $credentials = $loginRequest->only('email', 'password');
        if (!$this->authService->login($credentials)) {
            return response()->json(['status' => false, 'message' => 'wrong credentials, please try again', 401]);
        }
        $loginRequest->session()->regenerate();
        return response()->json(['status' => true, 'message' => 'login successfully.', 'user' => Auth::user()], 200);
    }
}
