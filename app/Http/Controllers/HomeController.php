<?php namespace App\Http\Controllers;

use App\Services\Curl;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/
    private $curl;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(){
		$this->middleware('guest');
        $this->curl = new Curl();
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('main.home.index');
	}

    public function citymap()
    {
        $missionService = new \App\Services\MissionService();
        $missions = $missionService->getMissions();
//        return $missions;
        return view('main.home.map',compact("missions"));
    }

    public function getVenues(){
        $venues = $this->curl->get("/map/venues",[
            "lat" => \Request::get("lat"),
            "lon" => \Request::get("lon")]);
        return $venues;
    }

    public function getEvents(){
        $events = $this->curl->get("/map/events",[
            "lat" => \Request::get("lat"),
            "lon" => \Request::get("lon")]);
        return $events;
    }


}
