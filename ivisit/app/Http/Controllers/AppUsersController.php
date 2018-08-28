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

    /**
     * Display a listing of resource
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $appUsers = AppUsers::filter($request->get('active'));
        return response()->json(['app_users'=> $appUsers], 200);
    }

    public function store(Request $request)
    {
        AppUsers::create($request->all());
        return response(['created'=>true],200);
    }

}
