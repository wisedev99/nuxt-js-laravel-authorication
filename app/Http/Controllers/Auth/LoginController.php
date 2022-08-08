<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        request()->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

        if (!$token  = auth()->attempt(request()->only(['email', 'password']))) {
            return response()->json([

                'errors' => [
                    'email' => ['Sorry we couldn\'t  sing you in with those details.']
                ]
            ], 422);
        }

        return (new UserResource(request()->user()))
            ->additional([
                'meta' => [
                    'token' => $token
                ]
            ]);
    }

    public function logout()
    {
        auth()->logout();
    }
}
