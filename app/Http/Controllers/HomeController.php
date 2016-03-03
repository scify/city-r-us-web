<?php

namespace App\Http\Controllers;

use App\Services\Curl;
use App\Services\MissionService;

class HomeController extends Controller {

    private $curl;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware('guest');
        $this->curl = new Curl();
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index() {
        return view('main.home.index');
    }
    
    public function mail() {
        $missionService = new MissionService();
        $missionService->suggestMission();
        return view('main.home.index');
    }

    public function termsAndConditions() {
        return view('main.home.termsAndConditions');
    }

    public function citymap() {
        $missionService = new MissionService();
        $missions = $missionService->getMissions();
        return view('main.home.map', compact("missions"));
    }

    public function getVenues() {
        $venues = $this->curl->get("/map/venues", [
            "lat" => \Request::get("lat"),
            "lon" => \Request::get("lon")]);
        return $venues;
    }

    public function getEvents() {
        $events = $this->curl->get("/map/events", [
            "lat" => \Request::get("lat"),
            "lon" => \Request::get("lon")]);
        return $events;
    }

}
