<?php

namespace App\Http\Controllers;

use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $validator = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);


        if (!auth()->attempt($validator)) {
            return response()->json(['error' => 'Unauthorised'])->setStatusCode(Response::HTTP_UNAUTHORIZED);
        } else {
            $user = auth()->user();
            $success['user'] = $user;
            $refreshtoken = $user->createToken($success['user']->email);
            $success['token'] = $refreshtoken;
            $user->api_token = $refreshtoken;
            $user->save();
            Auth::login($user);

            return response()->json(['success' => $success])
                ->header('Authorization', $refreshtoken)->setStatusCode(Response::HTTP_OK);
        }
    }

    public function loginFailed()
    {
        return response()->json(['error' => 'Unauthorised'])->setStatusCode(Response::HTTP_UNAUTHORIZED);
    }
}
