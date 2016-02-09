<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Facades\JWTService;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller {

    use AuthenticatesAndRegistersUsers;

    protected $redirectTo = '/missions';
    protected $redirectPath = '/missions';

    public function __construct(Guard $auth) {
        $this->auth = $auth;
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Override the default postLogin method
     * to add JWT support.
     *
     * @param Request $request
     * @return $this
     */
    public function postLogin(Request $request) {
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if ($this->auth->attempt($credentials, $request->has('remember'))) {
            //if the login is successful, save the jwt at a cookie
            $jwt = JWTService::setCookie();

            return redirect()->to($this->redirectPath())->withCookie(cookie()->forever('jwtToken', $jwt, 0, null, null, null, false));
        }

        return redirect($this->loginPath())
                        ->withInput($request->only('email', 'remember'))
                        ->withErrors([
                            'email' => $this->getFailedLoginMessage(),
        ]);
    }

    /**
     * Override the default getLogout method.
     * After logging out, unset/forget the jwt cookie.
     *
     * @return $this
     */
    public function getLogout() {
        //unset the cookie
        JWTService::unsetCookie();
        $this->auth->logout();
        return redirect('/');
    }

    public function getRegister() {
        return redirect('auth/login');
    }

}
