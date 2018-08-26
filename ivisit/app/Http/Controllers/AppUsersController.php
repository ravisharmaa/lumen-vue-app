<?php
namespace App\Http\Controllers;

use Tymon\JWTAuth\JWTAuth;
use App\AppUsers;

class AppUsersController extends Controller
{
    public function __construct(JWTAuth $jwtAuth)
    {
        $this->middleware('auth');
        $this->middleware('jwt.auth');
    }

    public function index()
    {
        dd($request);
    }
}
