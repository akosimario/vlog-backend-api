<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data)
    {
        return  User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'phone_number' => $data['phone_number'] ?? null,
            'birth_date'  => $data['birth_date'] ?? null,
            'gender' => $data['gender'] ?? null,
            'address'  => $data['address'] ?? null,
            'city' => $data['city'] ?? null,
        ]);
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
