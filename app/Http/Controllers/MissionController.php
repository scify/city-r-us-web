<?php namespace App\Http\Controllers;


use App\Http\Requests\MissionRequest;
use App\Models\Mission;
use App\Services\Curl;
use App\Services\FileService;
use App\Services\MissionService;

class MissionController extends Controller {

    private $missionService;
    private $fileService;
    private $curl;

    public function __construct() {
        $this->missionService = new MissionService();
        $this->fileService = new FileService();
        $this->curl = new Curl();
        $this->middleware('auth', ['except' => 'getObservations']);
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
            $mission = $data->message;
        else {
            $mission = null;
            //handle error
        }
        return view('main.missions.edit', compact('mission'));
    }

    public function show($id) {

        $data = $this->curl->get('/missions/byId', ['id' => $id]);
        if ($data->status == 'success')
            $mission = $data->message;
        else {
            $mission = null;
        }

        return view('main.missions.show', compact('mission'));
    }


    public function store() {

        $id = $this->missionService->storeMission();

        if ($id == 'logout') {
            \Auth::logout();
            \Session::flush();
            return \Redirect::route('/');
        }

        $file = \Input::file('file');

        if ($file != null) {
            $validateFile = $this->fileService->validateImage($file);

            if (!$validateFile['error']) {
                $this->missionService->storeImg($id, $file);
            } else {
                //else, redirect back with message
                \Session::flash('flash_message', $validateFile['message']);
                \Session::flash('flash_type', 'alert-danger');

                return \Redirect::back()->withInput();
            }
        }

        return \Redirect::route('mission/profile', ['id' => $id]);
    }


    public function update() {

        $id = $this->missionService->updateMission();

        if ($id == 'logout') {
            return \Redirect::route('/');
        } else {
            $file = \Input::file('file');

            if ($file != null) {
                $validateFile = $this->fileService->validateImage($file);

                if (!$validateFile['error']) {
                    $this->missionService->storeImg($id, $file);
                } else {
                    //else, redirect back with message
                    \Session::flash('flash_message', $validateFile['message']);
                    \Session::flash('flash_type', 'alert-danger');

                    return \Redirect::back()->withInput();
                }
            }

            return \Redirect::route('mission/profile', ['id' => $id]);
        }
    }


    /**
     * Delete a mission and its image
     *
     * @param $id
     * @return mixed
     */
    public function delete($id) {

        $result = $this->missionService->deleteMission($id);

        if ($result == 'logout') {
            return \Redirect::route('/');
        } else if ($result == 'has_users') {
            \Session::flash('flash_message', 'Η αποστολή δεν μπορεί να διαγραφεί γιατί συμμετέχουν χρήστες σε αυτή.');
            \Session::flash('flash_type', 'alert-danger');

            return \Redirect::back()->withInput();
        } else if($result!=null && strlen($result) > 0){
            $filename = public_path() . '/assets/uploads/volunteers/' . $result;

            //if the file exists, delete it from the filesystem
            if (file_exists($filename))
                unlink($filename);

            return \Redirect::route('missions');
        }
        return \Redirect::route('missions');
    }


    /**
     * Removes the image for a certain mission
     *
     * @param $id
     */
    public function removeImg($id) {
        $this->missionService->removeImg($id);
        return \Redirect::route('mission/profile', ['id' => $id]);
    }

    /**
     * Get observation data for a given mission
     *
     * @param $id
     * @return json
     */
    public function getObservations($id)
    {
        $missionService = new \App\Services\MissionService();
        $missionWithData= $missionService->getObservations($id);
        return response()->json($missionWithData);
    }

}
