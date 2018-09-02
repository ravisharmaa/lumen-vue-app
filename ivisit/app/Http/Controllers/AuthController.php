<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotFoundException;
use Illuminate\Support\Facades\Validator;
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
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'email' => 'required | email',
           'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()], 422);
        }

        if (!$token = $this->auth->attempt(['email' => $request->email, 'password' => sha1($request->password)])) {
            throw new UserNotFoundException();
        }

        return response(['token' => $token], 200);
    }
}
