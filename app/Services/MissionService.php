<?php namespace App\Services;

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
        $response = $this->curl->post('/missions/store',
            [
                'name' => \Request::get('name'),
                'description' => \Request::get('description')
            ],
            ['Authorization: Bearer ' . $this->jwtService->getCookie()]);

        return $response->message;
    }

    /**
     * Update a mission
     * 
     * @return mixed
     */
    public function updateMission() {
        //make the img_name column null
        $response = $this->curl->post('/missions/update', \Request::all(), ['Authorization: Bearer ' . $this->jwtService->getCookie()]);

        return $response->message;
    }


    /**
     * After a mission has been created,
     * save the file to the file system
     * and update the missions table to add the image path.
     */
    public function storeImg($id, $file) {
        //first check that mission already exists and retrieve it

        if ($file != null) {
            //save the filename to the db
            $id = $this->curl->post('/missions/' . $id . '/update',
                ['id' => $id,
                    'img_name' => $file->getClientOriginalName()
                ],
                ['Authorization: Bearer ' . $this->jwtService->getCookie()]);

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
            //delete the file from the file system
            $filename = public_path() . '/uploads/missions/' . $mission->img_name;

            if (file_exists($filename)) {
                //delete the old file from the file system
                unlink($filename);
            }


            //make the img_name column null
            $id = $this->curl->post('/missions/' . $mission->id . '/update',
                ['id' => $mission->id,
                    'img_name' => ''
                ],
                ['Authorization: Bearer ' . $this->jwtService->getCookie()]);
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

            //TODO: check if token is null/not set
            //update the img_name column
            $id = $this->curl->post('/missions/update',
                ['id' => $mission->id,
                    'img_name' => $file->getClientOriginalName()
                ],
                ['Authorization: Bearer ' . $_COOKIE['jwtToken']]);
        }

        return $id;
    }
}
