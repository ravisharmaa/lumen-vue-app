<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotFoundException;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;

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
     *
     * @throws UserNotFoundException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validate($request, [
                'email' => 'required',
                'password' => 'required',
        ]);
        if (!$token = $this->auth->attempt(['email' => $request->email, 'password' => sha1($request->password)])) {
            throw new UserNotFoundException();
        }

        return response(['token' => $token], 200);
    }
}
