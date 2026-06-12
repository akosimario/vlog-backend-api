<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\profileRequest;
use App\Http\Resources\profileResource;
use App\Services\ProfileService;
use Illuminate\Support\Facades\Auth;
class profileController extends Controller
{
    protected ProfileService $profileService;

    public function __construct(ProfileService $profileService){
        $this->profileService = $profileService;
    }
    public function show(){
        return response()->json(['status' => true,'data' => new ProfileResource(Auth::user()),]);
    }
     public function update(ProfileRequest $profileRequest){
        $this->profileService->update($profileRequest->validated(),Auth::user(),$profileRequest);
        return response()->json(['status'  => true,'message' => 'profile updated successfully.']);
    }
}
