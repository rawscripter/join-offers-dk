<?php

namespace App\Http\Controllers;


use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function user(Request $request)
    {
        return response(new UserResource($request->user()));
    }

    public function login(Request $request)
    {
        $http = new \GuzzleHttp\Client;
        try {
            $response = $http->post(env('PASSPORT_AUTH_URL'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => env('PASSPORT_CLIENT_ID'),
                    'client_secret' => env('PASSPORT_CLIENT_SECRET'),
                    'username' => $request->username,
                    'password' => $request->password
                ]
            ]);
            return $response->getBody();

        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if ($e->getCode() == 400) {
                return response()->json('Invalid Request. Please Enter a username or password.', $e->getCode());
            } else if ($e->getCode() == 401) {
                return response()->json('Invalid credentials. Please try again.', $e->getCode());
            }

            return response()->json('Something went wrong. Please try after sometime.', $e->getCode());
        }
    }

    public function register(Request $request)
    {
        $user = User::where('email', $request->username)->first();

        if (!$user) {
            User::create([
                'name' => $request->name,
                'email' => $request->username,
                'password' => Hash::make($request->password),
            ]);
            $http = new \GuzzleHttp\Client;
            try {
                $response = $http->post(env('PASSPORT_AUTH_URL'), [
                    'form_params' => [
                        'grant_type' => 'password',
                        'client_id' => env('PASSPORT_CLIENT_ID'),
                        'client_secret' => env('PASSPORT_CLIENT_SECRET'),
                        'username' => $request->username,
                        'password' => $request->password
                    ]
                ]);
                return $response->getBody();
            } catch (\GuzzleHttp\Exception\BadResponseException $e) {
                if ($e->getCode() == 400) {
                    return response()->json('Invalid Request. Please Enter a username or password.', $e->getCode());
                } else if ($e->getCode() == 401) {
                    return response()->json('Invalid credentials. Please try again.', $e->getCode());
                }
                return response()->json('Something went wrong. Please try after sometime.', $e->getCode());
            }
        } else {
            return response()->json('This email already in use.', 400);
        }

    }

    public function logout()
    {
        \auth()->user()->tokens()->each(function ($token, $key) {
            $token->delete();
        });
        return json_encode('Logged Out Successfully.');
    }
}
