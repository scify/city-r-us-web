<?php

namespace App\Http\Controllers;

use App\Services\Curl;
use Mail;

class UserController extends Controller {

    private $curl;

    public function __construct() {
        $this->curl = new Curl();
        $this->middleware('auth');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index($mission = 'total') {
        $users = $this->curl->get('/users/withScores', [])->message->users;
        $missions = $this->curl->get('/missions', [])->message->missions;
        $userInfo = [];
        foreach ($users as $user) {
            $curUser = [
                'id' => $user->id,
                'name' => $user->name,
                'total' => 0
            ];
            $curUser[$mission] = 0;
            foreach ($user->observation_points as $observation) {
                if ($observation->mission_id == $mission) {
                    $curUser[$observation->mission_id] = $curUser[$observation->mission_id] + intval($observation->points);
                } else if ($mission == 'total') {
                    $curUser[$mission] = $curUser[$mission] + intval($observation->points);
                }
            }
            $userInfo[] = $curUser;
        }
        foreach ($userInfo as $id => $user) {
            if ($user[$mission] == 0) {
                unset($userInfo[$id]);
            } else {
                $userInfo[$id]['value'] = $user[$mission];
            }
        }
        usort($userInfo, function ($u1, $u2) {
            return $u1['value'] > $u2['value'] ? -1 : 1;
        });
        return view('main.users.list', ['missions' => $missions, 'users' => $userInfo, 'active' => $mission]);
    }


    public function emailUser() {

        $user = $this->curl->get('/users/byId', ['id' => \Request::get('user')])->message->user;
        $email = $user->email;

        \Mail::send('emails.email_user', ['msg' => \Request::get('body'), 'user' => $user], function ($message) use ($email) {
            $message->to($email)->subject('Μήνυμα από την εφαρμογή City-R-US!');
        });

        return;
    }
}
