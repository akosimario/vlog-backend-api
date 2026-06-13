<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthService;

class LogoutController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }
    public function logout(Request $request){
        $this->authService->logout($request);
        return response()->json(['status' => true, 'message' => 'logged out successfully.'], 200);
    }
}
