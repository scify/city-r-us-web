<?php namespace App\Services;

class MissionService {

    private $curl;

    public function __construct() {
        $this->curl = new Curl();
    }

    /**
     * After a mission has been created,
     * save the file to the file system
     * and update the missions table to add the image path.
     */
    public function storeFile($file, $name) {
        //first check that mission alreasy exists and retrieve it
        $mission = $this->curl->get('/missions/byName', ['name' => $name]);

        if ($mission != null) {
            dd('aaaa');
            //then make an update to the mission
            $mission = $this->curl->post('/missions/' . $mission->id . 'update',
                [   'id' => $mission->id,
                    'img_name' => $file->getClientOriginalName()
                ]);
            return $mission;

        } else return 'mission not found';


        //return $this->curl->post();

    }
}
