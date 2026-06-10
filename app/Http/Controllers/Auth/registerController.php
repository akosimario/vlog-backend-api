<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\registerRequest;
use App\Models\User;
class registerController extends Controller
{
    public function authRegister(registerRequest $registerRequest){
        $validated = $registerRequest->validated();
        User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'phone_number' => $validated['phone_number'] ?? null,
            'birth_date'  => $validated['birth_date'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'address'  => $validated['address'] ?? null,
            'city' => $validated['city'] ?? null,
        ]);
        return response()->json(['status' => true, 'message' => "register succesfully"], 201);
    }
}
