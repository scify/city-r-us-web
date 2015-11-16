<?php namespace App\Http\Controllers;


use App\Http\Requests\MissionRequest;
use App\Models\Mission;
use App\Services\Curl;
use App\Services\MissionService;

class MissionController extends Controller {

    private $missionService;
    private $curl;

    public function __construct() {
        $this->missionService = new MissionService();
        $this->curl = new Curl();
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

    public function edit($id) {
        $data = $this->curl->get('/missions/byId', ['id' => $id]);
        if ($data->status == 'success')
            $mission = $data->message->mission;
        else{
            $mission = null;
            //handle error
        }

        return view('main.missions.edit', compact('mission'));
    }

    public function show($id) {
        return view('main.missions.show', compact('id'));
    }

    public function storeFile() {

        $file = \Input::file('file');
        $flag = false;
        if ($file != null) {
            $flag = true;
            $filename = public_path() . '/uploads/missions/' . $file->getClientOriginalName();

            //if file already exists, redirect back with error message
            if (file_exists($filename)) {
                \Session::flash('flash_message', 'Το αρχείο ' . $file->getClientOriginalName() . ' υπάρχει ήδη.');
                \Session::flash('flash_type', 'alert-danger');

                return \Redirect::back();
            }

            //if file exceeds maximum allowed size, redirect back with error message
            if ($file->getSize() > 10000000) {
                \Session::flash('flash_message', 'Το αρχείο ' . $file->getClientOriginalName() . ' ξεπερνά σε μέγεθος τα 10mb.');
                \Session::flash('flash_type', 'alert-danger');

                return \Redirect::back();
            }
            $allowed = array('gif', 'png', 'jpg');
            //if file is not an image, redirect back with an error
            if (!in_array($file->getClientOriginalExtension(), $allowed)) {
                \Session::flash('flash_message', 'Το αρχείο ' . $file->getClientOriginalName() . ' δεν είναι εικόνα.');
                \Session::flash('flash_type', 'alert-danger');

                return \Redirect::back();
            }
        }
        //dd(\Input::all());
        //store file to db and file system
            $id = $this->missionService->storeFile($file, \Request::get('name'), $flag);

        return \Redirect::route('mission/profile', ['id' => $id]);
    }

}
