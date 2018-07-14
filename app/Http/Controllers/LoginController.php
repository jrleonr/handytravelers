<?php

namespace Handytravelers\Http\Controllers;

use GuzzleHttp\Exception\ClientException;
use Handytravelers\Components\Users\Exceptions\UserEmailNotFoundException;
use Handytravelers\Components\Users\Exceptions\UserIsNotVerifiedOnFacebookException;
use Handytravelers\Components\Users\Exceptions\UserIsNotVerifyException;
use Handytravelers\Components\Users\Users;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
        /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->fields([
            'id', 'first_name', 'last_name', 'email', 'gender', 'birthday', 'locale', 'location', 'languages', 'hometown', 'age_range', 'timezone', 'cover', 'link', 'picture', 'updated_time', 'verified'
        ])->scopes([
            'email', 'user_birthday', 'user_hometown', 'user_hometown', 'user_location'
        ])->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleFacebookCallback(Users $users)
    {
        try {
            $facebookUser = Socialite::driver('facebook')->fields([
                'id', 'first_name', 'last_name', 'email', 'gender', 'birthday', 'locale', 'location', 'languages', 'hometown', 'age_range', 'timezone', 'cover', 'link', 'picture', 'updated_time', 'verified'
            ])->user();

            $user = $users->loginOrCreateFromFacebook($facebookUser->user);

            return $this->redirectUserTo($user);
        } catch (InvalidStateException $e) {
            return redirect('/')->with('error', 'Something failed. Please, try again.');
        } catch (ClientException $e) {
            return redirect('/')->with('error', 'Something failed. Please, try again. ');
        } catch (UserEmailNotFoundException $e) {
            return redirect()->route('user.email')->with('error', 'Hi, thanks for trying to register with Facebook, unfortunately you don\'t have an email address in Facebook. Please, provide one here.');
        } catch (UserIsNotVerifyException $e) {
            return redirect('/')->with('error', 'Your account is not verified. Please, go to your email and check if you recieve a link to do so.');
        } catch (UserIsNotVerifiedOnFacebookException $e) {
            return redirect('/')->with('error', 'Your account is not verified on Facebook. To create an account in Handytravelers your account needs to be verified.');
        }
    }

    //get
    public function getEmail()
    {
        return view('edit.email');
    }

    //post
    public function postEmail(Users $users)
    {
        try {
            $users->sendToken(request()->input('email'));
        } catch (QueryException $e) {
            return redirect('/')->with('error', 'The email you provide is already being use in our system. Please contact Handytravelers and we\'ll try to help you. ');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Something went wrong, please, try again.');
        }

        return redirect('/')->with('error', 'We sent an email with the steps to verify your account. Please, verify it now.');
    }

    //get
    public function getVerify(Users $users, $token)
    {
        try {
            $user = $users->verify($token);
           
            return $this->redirectUserTo($user);
        } catch (ModelNotFoundException $e) {
            return redirect('/')->with('error', 'It looks like that token is not longer valid.');
        }
    }

    protected function redirectUserTo($user)
    {
        if (!$user->isFilled()) {
            return redirect(route('edit.profile'));
        }

        return $this->sendLoginResponse(request());
    }
}
