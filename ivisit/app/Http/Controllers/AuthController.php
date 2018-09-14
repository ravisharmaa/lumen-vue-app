<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotFoundException;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    protected $auth;

    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param Request      $request
     * @param LoginRequest $loginRequest
     *
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     *
     * @throws UserNotFoundException
     * @throws \App\Exceptions\ValidationFailedException
     */
    public function login(Request $request, LoginRequest $loginRequest)
    {
        $loginRequest->validate($request);

        if (!$token = $this->auth->attempt(['email' => $request->email, 'password' => sha1($request->password)])) {
            throw new UserNotFoundException();
        }

        return response(['token' => $token], 200);
    }
}
