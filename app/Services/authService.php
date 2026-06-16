<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected UserRepository $userRepository;
    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }
    public function register(array $data){
        return $this->userRepository->create($data);
    }
    public function login(array $credentials){
        return Auth::attempt($credentials);
    }

    public function logout($request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
