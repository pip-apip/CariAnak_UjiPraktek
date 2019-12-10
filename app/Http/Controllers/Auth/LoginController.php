<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:perusahaan')->except('logout');
        $this->middleware('guest:kandidat')->except('logout');
    }

    // Multiple Login Perusahaan
    public function showPerusahaanLoginForm()
    {
        return view('auth/formlogin', ['url' => 'perusahaan']);
    }

    public function perusahaanLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:1'
        ]);

        if (Auth::guard('perusahaan')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/home');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    // Multiple Login Kandidat
    public function showKandidatLoginForm()
    {
        return view('auth/formlogin', ['url' => 'kandidat']);
    }

    public function kandidatLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:1'
        ]);

        if (Auth::guard('kandidat')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/home');
        }
        return back()->withInput($request->only('email', 'remember'));
    }
}
