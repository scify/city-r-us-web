<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Facades\JWTService;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers;

    protected $redirectTo = '/missions';
    protected $redirectPath = '/missions';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Override the default postLogin method
     * to add JWT support.
     *
     * @param Request $request
     * @return $this
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (\Auth::attempt($credentials, $request->has('remember'))) {

            if (\Auth::user()->roles() == null || !in_array('admin', \Auth::user()->roles()->lists('name', 'id')->toArray())) {
                return redirect($this->loginPath())
                    ->withErrors([
                        'error' => 'Δεν έχετε πρόσβαση στη σελίδα',
                    ]);

            }
            //if the login is successful, save the jwt at a cookie
            $jwt = JWTService::setCookie();

            return redirect()->to($this->redirectPath())
                ->withCookie(cookie()->forever('jwtToken', $jwt));
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
    public function getLogout()
    {
        //unset the cookie
        JWTService::unsetCookie();

        \Auth::logout();

        return redirect('/');
    }

    public function getRegister()
    {
        return redirect('auth/login');
    }

}
