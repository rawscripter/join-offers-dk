<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Resources\UserInfoResource;
use App\Http\Resources\UserResource;
use App\User;
use App\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    public function SocialSignup($provider)
    {
        // Socialite will pick response data automatic
        $user = Socialite::driver($provider)->stateless()->user();

        $user = SocialAccountsServiceController::findOrCreate($user, $provider);
        $data['access_token'] = $user->createToken('login')->accessToken;
        $data['token_type'] = "Bearer";
        return response()->json($data);
    }

    public function user(Request $request)
    {
        return response(new UserResource($request->user()));
    }

    public function getUserInfo(Request $request)
    {
        return response(new UserInfoResource($request->user()->info));
    }

    public function updatePassword(Request $request)
    {
        if ($request->newPassword == $request->confirmPassword) {
            $user = Auth::guard('api')->user();

            $newPass = Hash::make($request->newPassword);
            $user->password = $newPass;
            $user->save();

            $res['status'] = 200;
            $res['message'] = 'Password updated successfully.';
        } else {
            $res['status'] = 201;
            $res['message'] = 'Invalid Request.';
        }
        return response()->json($res);
    }

    public function updateInfo(Request $request)
    {
        $user = Auth::guard('api')->user();
        $user->info->update($request->except('email'));
        $user->name = $request->name;
        $user->save();
        $res['status'] = 200;
        $res['message'] = 'Info updated successfully.';
        return response()->json($res);
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

            $user = User::create([
                'name' => $request->name,
                'email' => $request->username,
                'password' => Hash::make($request->password),
            ]);

            UserInfo::create([
                'user_id' => $user->id,
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

    public function resetPassword(Request $request)
    {
        $this->validate($request, ['email' => 'required|email|exists:users']);

        $response = $this->broker()->sendResetLink($request->only('email'));
        return $response == Password::RESET_LINK_SENT
            ? [
                'success' => true,
                'msg' => 'Successful'
            ]
            : [
                'success' => false,
                'msg' => 'Reset email sending failed.'
            ];
    }

    public function broker()
    {
        return Password::broker();
    }

    public function confirmPassword(Request $request)
    {
        (new ResetPasswordController)->reset($request);
        $user = \auth()->user();
        if ($user) {
            $data['access_token'] = $user->createToken('login')->accessToken;
            $data['token_type'] = "Bearer";
            return response()->json($data);
        }
        return false;
    }
}
