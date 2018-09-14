<?php

namespace App\Http\Controllers;

use App\AppUsers;
use App\Exceptions\ValidationFailedException;
use App\Http\Requests\AppUsersRequest;
use Illuminate\Http\Request;
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
     * @param Request         $request
     * @param AppUsersRequest $appUsersRequest
     *
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     *
     * @throws ValidationFailedException
     */
    public function store(Request $request, AppUsersRequest $appUsersRequest)
    {
        $appUsersRequest->validate($request);
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
     * @param $id
     * @param Request         $request
     * @param AppUsersRequest $appUsersRequest
     *
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     *
     * @throws ValidationFailedException
     */
    public function update($id, Request $request, AppUsersRequest $appUsersRequest)
    {
        $appUsersRequest->validate($request);
        AppUsers::findOrFail($id)->update($request->except(['Password_confirmation']));

        return response(['message' => 'Resource Updated'], 200);
    }
}
