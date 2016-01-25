<?php namespace App\Http\Controllers;

use App\Services\Curl;

class UserController extends Controller{
    
    private $curl;

    public function __construct()
    {
        $this->curl = new Curl();
        $this->middleware('auth');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->curl->get('/users/withScores', [])->message->users;
        $missions = $this->curl->get('/missions', [])->message->missions;
        $userInfo = [];
        foreach ($users as $user) {
            $curUser = [
                'id' => $user->id,
                'name' => $user->name,
                'total' => 0
            ];
            foreach ($missions as $mission) {
                $curUser[$mission->id] = 0;
            }
            foreach ($user->observation_points as $observation) {
                $curUser[$observation->mission_id] = $curUser[$observation->mission_id] + intval($observation->points);
                $curUser['total'] = $curUser['total'] + intval($observation->points);
            }
            $userInfo[] = $curUser;
        }
        return view('main.users.list', ['missions' => $missions, 'users' => $userInfo]);
    }
}
