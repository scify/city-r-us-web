<?php namespace App\Http\Controllers;

use App\Services\Curl;

class AdminController extends Controller {


    private $curl;

    public function __construct() {
        $this->middleware('auth');
        $this->curl = new Curl();

    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index() {

        $missions = sizeof($this->curl->get('/missions', [])->message->missions);
        $users = sizeof($this->curl->get('/users', [])->message->users);
        $observations = sizeof($this->curl->get('/observations', [])->message->observations);

        return view('main.dashboard.dashboard', compact('missions', 'users', 'observations'));
    }

}
