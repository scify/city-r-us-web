<?php namespace App\Http\Controllers;



class MissionController extends Controller{


    public function __construct()
    {
       // $this->middleware('jwt.auth');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        return view('main.missions.list');
    }
}
