<?php namespace App\Http\Controllers;


use App\Http\Requests\MissionRequest;
use App\Models\Mission;

class MissionController extends Controller {


    public function __construct() {
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index() {
        return view('main.missions.list');
    }

    public function create() {
        return view('main.missions.create');
    }

    public function edit() {
        return view('main.missions.edit');
    }


    public function store(MissionRequest $request) {

        $mission = Mission::create($request->all());

        return $mission;

       // return Redirect::route('action/one', ['id' => $action->id]);
    }
}
