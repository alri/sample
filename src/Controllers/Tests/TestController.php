<?php

namespace Alri\Sample\Controllers\Tests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ('Test Controller Is Ready !!!');
    }

    public function insert()
    {

    }

    public function show()
    {

    }

}
