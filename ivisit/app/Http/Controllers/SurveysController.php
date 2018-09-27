<?php

namespace App\Http\Controllers;

use App\Survey;

class SurveysController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('jwt.auth');
    }

    /**
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function index()
    {
        $surveys = Survey::all();

        return response(['surveys' => $surveys], 200);
    }

    public function store()
    {

    }
}
