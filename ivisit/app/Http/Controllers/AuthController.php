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

    public function login(Request $request)
    {
        $this->validate($request, [
                'email' => 'required',
                'password'=>'required'
        ]);
        if (!$token = $this->auth->attempt(['email'=>$request->email, 'password'=>sha1($request->password)])) {
            throw new UserNotFoundException;
        }
        return response(['token'=>$token], 200);
    }
}
