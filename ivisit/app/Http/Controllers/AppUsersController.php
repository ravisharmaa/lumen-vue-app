<?php
namespace App\Http\Controllers;
use App\AppUsers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;


class AppUsersController extends Controller
{
    public function __construct(JWTAuth $jwtAuth)
    {
        $this->middleware('auth');
        $this->middleware('jwt.auth');
    }

    public function index(Request $request)
    {
        $appUsers = AppUsers::filter($request->get('active'))->get();
        dd($appUsers);
        return response()->json(['app_users'=> $appUsers],200);
    }






}
