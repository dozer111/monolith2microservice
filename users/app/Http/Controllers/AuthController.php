<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create(
            $request->only('first_name', 'last_name', 'email','is_admin')
            + [
                'password' => \Hash::make($request->input('password'))
            ]
        );

        return response($user, Response::HTTP_CREATED);
    }
}
