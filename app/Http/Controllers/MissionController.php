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
        return view('main.missions.show', compact('id'));
    }


    public function store(){

        $id = $this->missionService->storeMission();

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

        return view('main.missions.show', compact('id'));
    }


    public function update(){

        $id = $this->missionService->updateMission();

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

        return view('main.missions.show', compact('id'));
    }



    /**
     * Delete a mission and its image
     *
     * @param $id
     */
    public function delete($id) {

        $mission = $this->curl->get('/missions/byId', ['id' => $id])->message;


        //if there are users participating in the mission, do not delete
        if (sizeof($mission->users) > 0) {
            \Session::flash('flash_message', 'Η αποστολή δεν μπορεί να διαγραφεί γιατί συμμετέχουν χρήστες σε αυτή.');
            \Session::flash('flash_type', 'alert-danger');

            return \Redirect::back()->withInput();
        }

        $filename = public_path() . '/assets/uploads/volunteers/' . $mission->img_name;

        //if the file exists, delete it from the filesystem
        if (file_exists($filename))
            unlink($filename);

        return;
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
}
