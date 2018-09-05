<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotFoundException;
use Illuminate\Validation\ValidationException;
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
     * @param Request $request
     *
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     * @throws ValidationException
     * @throws UserNotFoundException
     */
    public function login(Request $request, LoginRequest $loginRequest)
    {
        $loginRequest->validate($request);

        if (!$token = $this->auth->attempt(['email' => $request->email, 'password' => sha1($request->password)])) {
            throw new UserNotFoundException;
        }

        return response(['token' => $token], 200);
    }
}
