<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\registerRequest;
use App\Models\User;
use App\Services\AuthService;
class registerController extends Controller
{
    protected AuthService $authService;
    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }
    public function authRegister(registerRequest $registerRequest){
        $this->authService->register($registerRequest->validated());
        return response()->json(['status' => true, 'message' => "register succesfully"], 201);
    }
}
