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
     * Displays a listing of resource.
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
            'Password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()], 422);
        }

        AppUsers::create($request->except(['Password_confirmation']));

        return response(['created' => true], 200);
    }

    /**
     * Finds a resource.
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function edit($id)
    {
        return response(['app_user' => AppUsers::findOrFail($id)], 200);
    }

    /**
     * Updates a resource.
     *
     * @param $id
     * @param Request $request
     *
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function update($id, Request $request)
    {
        AppUsers::findOrFail($id)->update($request->all());

        return response(['message' => 'Resource Updated'], 200);
    }
}
