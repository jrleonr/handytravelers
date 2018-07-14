<?php

namespace Handytravelers\Components\Users;

use Auth;
use Handytravelers\Components\Homes\Models\Home;
use Handytravelers\Components\Images\Images;
use Handytravelers\Components\Places\Places;
use Handytravelers\Components\Users\Exceptions\UserEmailNotFoundException;
use Handytravelers\Components\Users\Exceptions\UserIsNotVerifyException;
use Handytravelers\Components\Users\Models\User;
use Handytravelers\Notifications\ConfirmUserEmail;
use Handytravelers\Notifications\UserRegistered;
use Log;
use Ramsey\Uuid\Uuid;

class Users
{

    const GRAPH_URL = 'https://graph.facebook.com';
    const VERSION = 'v3.0';

    /**
     * Get user from Facebook email or create it
     * 
     * @param  array  $attributes
     * @return User           
     */
    public function loginOrCreateFromFacebook(array $attributes)
    {
        $user = (isset($attributes['email'])) ? User::byEmail($attributes['email']) : null;

        if (!$user) {
            $user = User::byFacebookId($attributes['id']);
        }

        if (!$user) {
            $user  = [
                'facebook_id' => $attributes['id'],
                'first_name' => $attributes['first_name'],
                'last_name' => $attributes['last_name'] ?? null,
                'email' => $attributes['email'] ?? null,
                'gender' => $attributes['gender'] ?? 'male',
                'date_of_birth' => $attributes['birthday'] ?? null,
                'timezone' => $attributes['timezone'] ?? null,
                'locale' => $attributes['locale'] ?? null,
                'verified' => (!isset($attributes['email'])) ? 0 : 1
            ];
            
            if (isset($attributes['location'])) {
                try {
                    $user['location'] = Places::setPlace($attributes['location']['name'])['city'];
                } catch (GooglePlacesApiException $e) {
                    $user['location'] = null;
                }
            }

            if (isset($attributes['hometown'])) {
                try {
                    $user['hometown'] = Places::setPlace($attributes['hometown']['name'])['city'];
                } catch (GooglePlacesApiException $e) {
                    $user['hometown'] = null;
                }
            }
            
            $user = $this->create($user);
        } else {
            if (is_null($user->facebook_id)) {
                $data  = [
                    'facebook_id' => $attributes['id'],
                    'date_of_birth' => $attributes['birthday'] ?? null,
                    'timezone' => $attributes['timezone'] ?? null,
                    'locale' => $attributes['locale'] ?? null,
                ];

                $user->update($data);
            }
        }
        
        if (!($attributes['picture']['data']['is_silhouette'] ?? null) && ! $user->images()->where('main', 1)->get()->count()) {
            $this->getFacebookImage($attributes['id'], $user->id);
        }

        if (!$user->verified && !$user->email) {
            session(['verify.user_id' => $user->username]);

            throw new UserEmailNotFoundException($user);
        }

        if (!$user->verified) {
            session(['verify.user_id' => $user->username]);

            throw new UserIsNotVerifyException($user);
        }

        
        auth()->login($user, true);


        return $user;
    }

    private function create(array $attributes)
    {
        $user = User::create([
            'username' => Uuid::uuid4(),
            'facebook_id' => $attributes['facebook_id'],
            'first_name' => $attributes['first_name'],
            'last_name' => $attributes['last_name'],
            'gender' => $attributes['gender'],
            'date_of_birth' => $attributes['date_of_birth'],
            'email' => $attributes['email'],
            'place_id' => $attributes['hometown'] ?? null,
            'timezone' => $attributes['timezone'],
            'locale' => $attributes['locale'],
            'verified' => $attributes['verified']
        ]);

        $home = Home::create([
            'place_id' => $attributes['location'] ?? null
        ]);

        $user->home_id = $home->id;
        $user->save();

        $user->notify(new UserRegistered());

        return $user;
    }


    //verify email to check
    public function sendToken($email)
    {
        $user = User::where('username', session()->pull('verify.user_id'))->firstOrFail();

        $user->email = $email;
        $user->save();

        $user->notify(new ConfirmUserEmail());
    }

    public function verify($token)
    {
        $user = User::where('token', $token)->firstOrFail();

        $user->token = null;
        $user->verified = 1;
        $user->save();

        $user->notify(new UserRegistered());

        auth()->login($user, true);

        return $user;
    }

    private function getFacebookImage($facebook_id, $user_id)
    {
        $contents = self::GRAPH_URL .'/'. self::VERSION .'/'.$facebook_id .'/picture?height=720&width=720&type=normal&redirect=false';
        $fbImage = json_decode(file_get_contents($contents), true);
        $fbImage = file_get_contents($fbImage['data']['url']);
        (new Images)->newPhoto($fbImage, $user_id);
    }
}
