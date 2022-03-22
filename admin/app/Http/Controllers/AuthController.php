<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateInfoRequest;
use App\Http\Requests\UpdatePasswordRequest;
use dozer111\UsersMicroservice\UsersApi;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    private UsersApi $service;

    public function __construct(UsersApi $service)
    {
        $this->service = $service;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->only('first_name', 'last_name', 'email','password')
            + ['is_admin' =>  1];

        $user = $this->service->post('register',$data);

        return response($user, Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        $scope = 'admin';

        $data = $request->only('email','password') + compact('scope');

        $response = $this->service->post('login',$data);
        $cookie = cookie('jwt', $response['jwt'], 60 * 24); // 1 day

        return response([
            'message' => 'success'
        ])->withCookie($cookie);
    }

    public function user()
    {
        return $this->service->get('user');
    }

    public function logout()
    {
        $cookie = \Cookie::forget('jwt');
        $this->service->post('logout',[]);

        return response([
            'message' => 'success'
        ])->withCookie($cookie);
    }

    public function updateInfo(UpdateInfoRequest $request)
    {
        $user = $this->service->put(
            'users/info',
            $request->only('first_name', 'last_name', 'email')
        );
        return response($user, Response::HTTP_ACCEPTED);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = $this->service->put(
            'users/info',
            $request->only('password')
        );

        return response($user, Response::HTTP_ACCEPTED);
    }
}
