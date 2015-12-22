<?php namespace App\Http\Controllers;

use App\Services\Curl;

class HomeController extends Controller {

	private $curl;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
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
        return view('main.home.map',compact("missions"));
    }


    public function getVenues(){
        $venues = $this->curl->get("/map/venues", [
            "lat" => \Request::get("lat"),
            "lon" => \Request::get("lon")]);

        return '['.$venues.']';
        var_dump($venues);

        foreach($venues as $ven){
            return $ven->name;

        }

        return $venues;
    }



}
