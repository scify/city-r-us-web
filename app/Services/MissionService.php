<?php

namespace App\Services;

class MissionService {

    private $curl;
    private $jwtService;

    public function __construct() {
        $this->curl = new Curl();
        $this->jwtService = new JWTService();
    }

    /**
     * Store a mission
     *
     * @return mixed
     */
    public function storeMission() {

        $jwt = $this->jwtService->getCookie();
        if ($jwt == null)
            return 'logout';

        $response = $this->curl->post('/missions/store', [
            'name' => \Request::get('name'),
            'description' => \Request::get('description'),
            'mission_type' => \Request::get('mission_type')
                ], ['Authorization: Bearer ' . $jwt]);

        if (isset($response->error))
            return 'logout';

        return $response->message;
    }

    /**
     * Update a mission
     *
     * @return mixed
     */
    public function updateMission() {
        $jwt = $this->jwtService->getCookie();
        if ($jwt == 'logout')
            return 'logout';

        $response = $this->curl->post('/missions/update', \Request::all(), ['Authorization: Bearer ' . $jwt]);

        if (isset($response->error) || $response->status === "error") {
            \Auth::logout();
            \Session::flush();
            return 'logout';
        }
        return $response->message;
    }

    /**
     * After a mission has been created,
     * save the file to the file system
     * and update the missions table to add the image path.
     */
    public function storeImg($id, $file) {

        if ($file != null) {

            $jwt = $this->jwtService->getCookie();
            if ($jwt == 'logout')
                return 'logout';

            //save the filename to the db
            $id = $this->curl->post('/missions/' . $id . '/update', ['id' => $id,
                'img_name' => $file->getClientOriginalName()
                    ], ['Authorization: Bearer ' . $jwt]);

            //save the file to the file system
            $path = public_path() . '/uploads/missions';
            $fileName = $file->getClientOriginalName();

            $file->move($path, $fileName); // uploading file to given path
        }
        return $id;
    }

    /**
     * Remove the image for a certain mission.
     * First delete the file from the file system
     * and then set the img_name column to empty string.
     *
     * @param $id
     */
    public function removeImg($id) {

        $mission = $this->curl->get('/missions/byId', ['id' => $id])->message;

        if ($mission != null && !empty($mission->img_name)) {

            $jwt = $this->jwtService->getCookie();
            if ($jwt == 'logout')
                return 'logout';

            //delete the file from the file system
            $filename = public_path() . '/uploads/missions/' . $mission->img_name;

            if (file_exists($filename)) {
                //delete the old file from the file system
                unlink($filename);
            }

            //make the img_name column null
            $id = $this->curl->post('/missions/' . $mission->id . '/update', ['id' => $mission->id,
                'img_name' => ''
                    ], ['Authorization: Bearer ' . $jwt]);
        }
        return $mission->id;
    }

    /**
     * Update the img of a certain mission.
     * First retrieve the missions from the db,
     * get the img_name and delete from the file system.
     * Then move the new image to the correct folder
     * and set the new img_name.
     *
     * @param $id
     * @param $file
     * @return mixed
     */
    public function updateImg($id, $file) {

        $mission = $this->curl->get('/missions/byId', ['id' => $id])->message;

        if ($mission != null) {

            $jwt = $this->jwtService->getCookie();
            if ($jwt == 'logout')
                return 'logout';

            if (!empty($mission->img_name)) {
                $filename = public_path() . '/uploads/missions/' . $mission->img_name;
                if (file_exists($filename)) {
                    //delete the old file from the file system
                    unlink($filename);
                }
            }

            //upload the new file to the server
            $path = public_path() . '/uploads/missions';
            $fileName = $file->getClientOriginalName();
            $file->move($path, $fileName);

            //update the img_name column
            $id = $this->curl->post('/missions/update', ['id' => $mission->id,
                'img_name' => $file->getClientOriginalName()
                    ], ['Authorization: Bearer ' . $jwt]);
        }
        return $id;
    }

    public function deleteMission($id) {

        $mission = $this->curl->get('/missions/byId', ['id' => $id]);

        if (!isset($mission->code)) {
            $mission = $mission->message;
            //if there are users participating in the mission, do not delete
            if (sizeof($mission->users) > 0) {
                return 'has_users';
            }

            $jwt = $this->jwtService->getCookie();
            if ($jwt == 'logout')
                return 'logout';

            //update the img_name column
            $response = $this->curl->post('/missions/' . $id . '/delete', [], ['Authorization: Bearer ' . $jwt]);

            return $mission->img_name;
        }
        return;
    }

    public function getMissions() {
        return $this->curl->get('/missions', []);
    }

    public function getObservations($missionid) {
        return $this->curl->get('/missions/' . $missionid . "/observations", []);
    }

    public function suggestMission() {
        return $this->curl->post('/missions/suggestWeb', [
                    'name' => \Request::get('name'),
                    'description' => \Request::get('description'),
                    'mail' => \Request::get('mail')
        ]);
    }

}
