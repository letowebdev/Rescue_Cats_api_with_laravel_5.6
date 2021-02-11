<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Users\PrivateUserResource;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('logout');
    }
    public function action(LoginRequest $request)
    {
        if (!$token = Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'errors' => [
                    'email' => ['Couldn\'t sign you in, please check your credentials and ty again']
                ]
                ], 422);
        }

        return (new PrivateUserResource($request->user()))
                ->additional([
                    'meta' => [
                        'token' => $token
                    ]
                ]);
    }


    public function logout()
    {
        auth()->guard('api')->logout();

        return response()->json(['message' => 'Logged out']);
    }
}
