<?php namespace App\Http\Controllers;



class UserController extends Controller{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        return view('main.users.list');
    }
}
