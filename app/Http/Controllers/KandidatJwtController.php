<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kandidat;
use Illuminate\Support\Facades\Hash;
use AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class KandidatJwtController extends Controller
{
    // public $successStatus = 200;
    
		// public function login(){
		// 	if(Auth::guard('kandidat')->attempt(['email' => request('email'), 'password' => request('password')])){
		// 		$user = Auth::guard('kandidat');
		// 		$success['token'] =  $user->createToken('nApp')->accessToken;
		// 		return response()->json(['success' => $success], $this->successStatus);
		// 	}
		// 	else{
		// 		return response()->json(['error'=>'Unauthorised'], 401);
		// 	}
		// }
		// public function register(Request $request)
		// {
		// 	$validator = Validator::make($request->all(), [
		// 		'name' => 'required',
		// 		'email' => 'required|email',
		// 		'password' => 'required',
    //             'c_password' => 'required|same:password',
    //             'alamat' => 'required',
    //             'kota' => 'required',
    //             'provinsi' => 'required',
    //             'negara' => 'required',
    //             'tgl_lahir' => 'required',
    //             'tmp_lahir' => 'required',
		// 	]);
		// 	if ($validator->fails()) {
		// 		return response()->json(['error'=>$validator->errors()], 401);            
		// 	}
		// 	$input = $request->all();
		// 	$input['password'] = bcrypt($input['password']);
		// 	$user = Kandidat::create($input);
		// 	$success['token'] =  $user->createToken('nApp')->accessToken;
		// 	$success['name'] =  $user->name;
		// 	return response()->json(['success'=>$success], $this->successStatus);
		// }
		// public function details()
		// {
		// 	$user = Auth::guard('kandidat');
		// 	return response()->json(['success' => $user], $this->successStatus);
		// }







    public function login(Request $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];
        if ($token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['Token' => $token]);
        } else {
            return response()->json(['result'=>false]);
        }
    }
    
        
    // if (!$token = auth('api')->attempt($credentials)) {
    //     return response()->json(['error' => 'Unauthorized'], 401);
    // }
    // return response()->json([
    //     'token' => $token,
    //     'expires' => auth('api')->factory()->getTTL() * 60,
    // ]);
    // }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:1|confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $kandidat = Kandidat::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'alamat' => $request->get('alamat'),
            'kota' => $request->get('kota'),
            'provinsi' => $request->get('provinsi'),
            'negara' => $request->get('negara'),
            'tgl_lahir' => $request->get('tgl_lahir'),
            'tmp_lahir' => $request->get('tmp_lahir'),
        ]);

        $token = JWTAuth::fromUser($kandidat);

        return response()->json(compact('kandidat','token'),201);
    }

    public function getAuthenticatedKandidat()
    {
        try {

            if (! $this->guard('api')->parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('this'));
    }
}
