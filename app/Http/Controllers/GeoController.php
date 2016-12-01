<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeoController extends Controller
{
    /**
     * Where to redirect users after processing the form.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->redirectTo);
    }
}
