<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Perusahaan;
use App\Kandidat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
        $this->middleware('guest:perusahaan');
        $this->middleware('guest:kandidat');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    // Multiple Login Show Form
    public function showPerusahaanRegisterForm()
    {
        return view('auth.register', ['url' => 'perusahaan']);
    }

    public function showKandidatRegisterForm()
    {
        return view('auth.register', ['url' => 'kandidat']);
    }

    // Multiple Login create
    protected function createPerusahaan(Request $request)
    {
        $this->validator($request->all())->validate();

        $perusahaan = Perusahaan::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'alamat' => $request['alamat'],
            'telp' => $request['telp'],
            'kota' => $request['kota'],
            'provinsi' => $request['provinsi'],
            'negara' => $request['negara'],
            'avatar' => $request['avatar'],
            'website' => $request['website'],
        ]);
        return redirect('formlogin/perusahaan');
    }

    protected function createKandidat(Request $request)
    {
        $this->validator($request->all())->validate();

        $kandidat = Kandidat::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'alamat' => $request['alamat'],
            'kota' => $request['kota'],
            'provinsi' => $request['provinsi'],
            'negara' => $request['negara'],
            'tgl_lahir' => $request['tgl_lahir'],
            'tmp_lahir' => $request['tmp_lahir'],
            'skills' => $request['skills'],
            'pendidikan' => $request['pendidikan'],
        ]);
        return redirect('formlogin/kandidat');
    }

}
