<?php

namespace App\Http\Controllers;

use App\LinkedSocialAccount;
use App\User;
use App\UserInfo;
use Illuminate\Http\Request;
use Laravel\Socialite\Two\User as ProviderUser;

class SocialAccountsServiceController extends Controller
{
    public static function findOrCreate(ProviderUser $providerUser, string $provider): User
    {
        $linkedSocialAccount = LinkedSocialAccount::where('provider_name', $provider)
            ->where('provider_id', $providerUser->getId())
            ->first();

        if ($linkedSocialAccount) {
            return $linkedSocialAccount->user;
        } else {
            $user = null;

            if ($email = $providerUser->getEmail()) {
                $user = User::where('email', $email)->first();
            }
            if (!$user) {
                $user = User::create([
                    'firstname' => $providerUser->getName(),
                    'profile_picture' => $providerUser->getAvatar(),
                    'email' => $providerUser->getEmail(),
                ]);
                UserInfo::create(['user_id' => $user->id]);
            }
            $user->linkedSocialAccounts()->create([
                'provider_id' => $providerUser->getId(),
                'provider_name' => $provider,
            ]);
            return $user;
        }
    }
}
