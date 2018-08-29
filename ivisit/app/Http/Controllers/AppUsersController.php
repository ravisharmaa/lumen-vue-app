<?php

namespace App\Http\Controllers;

use App\AppUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\JWTAuth;

class AppUsersController extends Controller
{
    /**
     * AppUsersController constructor.
     *
     * @param JWTAuth $jwtAuth
     */
    public function __construct(JWTAuth $jwtAuth)
    {
        $this->middleware('auth');
        $this->middleware('jwt.auth');
    }

    /**
     * Display a listing of resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $appUsers = AppUsers::filter($request->get('active'));

        return response()->json(['app_users' => $appUsers], 200);
    }

    /**
     * Stores a resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'UserName' => 'required',
            'SalesRepName' => 'required',
            'SalesRepDepartment' => 'required',

        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->getMessageBag()], 422);
        }

        AppUsers::create($request->all());

        return response(['created' => true], 200);
    }
}
