<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController
{
    public function store(LoginRequest $request)
    {
        abort_if(
            !Auth::attempt($request->only(['email', 'password'])),
            Response::HTTP_UNAUTHORIZED,
            'Invalid Credentials'
        );

        $user = User::where('email', $request->email)->firstOrFail();

        return response()->json([
            'access_token' => $user->createToken(config('app.name'))->accessToken,
        ]);
    }
}
