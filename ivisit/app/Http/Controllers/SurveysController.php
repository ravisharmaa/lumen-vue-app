<?php

namespace App\Http\Controllers;

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

    public function index()
    {
        return null;
    }
}
