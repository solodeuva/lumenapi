<?php

namespace App\Http\Controllers;
use App\User;

class ExampleController extends Controller
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

    public function usuarios(){
        return response()->json(['status'=>200,'data'=>User::all()],200);
    }
}
