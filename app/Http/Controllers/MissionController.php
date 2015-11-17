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

                return \Redirect::back()->withInput();
            }

            //if file exceeds maximum allowed size, redirect back with error message
            if ($file->getSize() > 10000000) {
                \Session::flash('flash_message', 'Το αρχείο ' . $file->getClientOriginalName() . ' ξεπερνά σε μέγεθος τα 10mb.');
                \Session::flash('flash_type', 'alert-danger');

                return \Redirect::back()->withInput();
            }
            $allowed = array('gif', 'png', 'jpg', 'jpeg');
            //if file is not an image, redirect back with an error
            if (!in_array($file->getClientOriginalExtension(), $allowed)) {
                \Session::flash('flash_message', 'Το αρχείο ' . $file->getClientOriginalName() . ' δεν είναι εικόνα.');
                \Session::flash('flash_type', 'alert-danger');

                return \Redirect::back()->withInput();
            }
        }

        //store file to db and file system
        $id = $this->missionService->storeFile($file, \Request::get('name'), $flag);

        return \Redirect::route('mission/profile', ['id' => $id]);
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

    /**
     * Update a certain mission's image
     * @return mixed
     */
    public function updateImg($id) {
        $file = \Input::file('file');

        if ($file != null) {
            $validateFile = $this->fileService->validateImage($file);

            if (!$validateFile['error']) {
                //if image is valid, update it
                $this->missionService->updateImg($id, $file);
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
