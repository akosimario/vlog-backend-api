<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\File;

class ProfileService{
    public function update(array $data, User $user, $request){
        if ($request->hasFile('avatar')) {
            $data['avatar_url'] = $this->handleAvatarUpload($request);
        }
        $user->update([
            'first_name' => $data['first_name'] ?? $user->first_name,
            'last_name' => $data['last_name'] ?? $user->last_name,
            'phone_number' => $data['phone_number'] ?? $user->phone_number,
            'birth_date' => $data['birth_date'] ?? $user->birth_date,
            'gender' => $data['gender'] ?? $user->gender,
            'address' => $data['address']?? $user->address,
            'city' => $data['city'] ?? $user->city,
            'avatar_url'=> $data['avatar_url'] ?? $user->avatar_url,
        ]);

        return $user;
    }
    private function handleAvatarUpload($request){
        $fileName = $request->file('avatar')->hashName();
        $request->file('avatar')->move(public_path('uploads/avatars'), $fileName);
        return asset('uploads/avatars/' . $fileName);
    }
}