<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\User;
use App\Kandidat;

class UserController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()
            ->json([
                'status' => 'ok',
                'token' => $token,
            ]);
    }

    public function kandidat(Request $request)
    {
        $kandidat = Kandidat::create([
            'name' => $request->input('name'),
            'email' =>$request->input('email'),
            'password' => Hash::make($request->input('password')),
            'alamat' =>$request->input('alamat'),
            'kota' =>$request->input('kota'),
            'provinsi' =>$request->input('provinsi'),
            'negara' =>$request->input('negara'),
            'tgl_lahir' =>$request->input('tgl_lahir'),
            'tmp_lahir' =>$request->input('tmp_lahir'),
            'avatar' =>$request->input('avatar'),
            'skills' =>$request->input('skills'),
            'pendidikan' =>$request->input('pendidikan'),
        ]);

        $token = JWTAuth::fromUser($kandidat);

        return response()
                ->json([
                    'status' => 'true',
        ]);
    }
// Nyoba Nyoba
//     public function store(Request $request)
//   {
//       $incoming = $_SERVER['CONTENT_TYPE'];

//       if ($incoming != 'application/json') {
//           header($_SERVER['SERVER_PROTOCOL'] . '500 internal server error');
//           exit();
//       }

//       $content = trim(file_get_contents("php://input"));
//       $decoded = json_decode($content, true);
//       $data = array();
//       if ($decoded['name'] == 'luthfi'){
//           $data = array(
//               "name" => "Luthfi Ali Qodri",
//               "email" => "Lut@gmail.com",
//               "password" => "Luthfi Ali Qodri",
//               "alamat" => "Jalan Harum Manis",
//               "kota" => "Depok",
//               "provinsi" => "Jawa Barat",
//               "negara" => "Indonesia",
//               "tgl_lahir" => "26-02-2002",
//               "tmp_lahir" => "Magelang",
//               "avatar" => "Luthfi Ali Qodri",
//               "skills" => "PHP",
//               "pendidikan" => "SMK"
//           );
//       }
//       header('Content-Type: application/json');
//       echo json_encode(array("data" => $data));
//   }


    public function profile()
    {
        $user = Auth::user();
        return view('layouts.profile',compact('user',$user));
    }

    public function update_avatar(Request $request){

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

        $request->avatar->storeAs('avatars',$avatarName);

        $user->avatar = $avatarName;
        $user->save();

        return back()
            ->with('success','You have successfully upload image.');

    }
    
}
