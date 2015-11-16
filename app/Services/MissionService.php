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
    public function storeFile($file, $name, $flag) {
        //first check that mission already exists and retrieve it
        $mission = $this->curl->get('/missions/byName', ['name' => $name]);

        if ($mission != null && $file != null && $flag == true ) {
            //save the filename to the db
            $id = $this->curl->post('/missions/' . $mission->id . '/update',
                ['id' => $mission->id,
                    'img_name' => $file->getClientOriginalName()
                ]);

            //save the file to the file system
            $path = public_path() . '/uploads/missions';
            $fileName = $file->getClientOriginalName();

            $file->move($path, $fileName); // uploading file to given path

        }
        dd($mission);
        return $mission->id;
    }
}
