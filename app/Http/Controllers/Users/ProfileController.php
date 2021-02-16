<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserProfileUpdateRequest;
use App\Http\Resources\Users\PrivateUserResource;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function update(UserProfileUpdateRequest $request)
    {
        $user = auth()->user();
        
        $user->update($request->only(['tagline', 'name', 'about', 'formatted_address', 'available_to_volunteer']));


        return new PrivateUserResource($user);
    }
}
