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
        $mission = $this->curl->get('/missions/byName', ['name' => $name])->message;

        if ($mission != null && $file != null && $flag == true) {
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
        return $mission->id;
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
                ['Authorization: Bearer ' . $_COOKIE['jwtToken']]);
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

            //update the img_name column
            $id = $this->curl->post('/missions/' . $mission->id . '/update',
                ['id' => $mission->id,
                    'img_name' => $file->getClientOriginalName()
                ],
                ['Authorization: Bearer ' . $_COOKIE['jwtToken']]);
        }

        return $id;
    }
}
