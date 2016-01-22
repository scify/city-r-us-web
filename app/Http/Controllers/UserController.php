<?php namespace App\Http\Controllers;

use App\Services\Curl;
use App\Services\MissionService;

class UserController extends Controller{
    
    private $userService;
    private $missionService;
    private $curl;

    public function __construct()
    {
        $this->missionService = new MissionService();
        $this->curl = new Curl();
        $this->middleware('auth');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->curl->get('/users', []);
        $missions = $this->curl->get('/missions', []);
        return view('main.users.list', ['missions' => $missions->message->missions, 'users' => $users->message->users]);
    }
}
