<?php 

namespace Handytravelers\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client as Guzzle;
use Handytravelers\Components\Requests\Models\Request as r;
use Handytravelers\Components\Images\Images;
use Handytravelers\Components\Places\Models\Place;
use Handytravelers\Components\Users\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LandingController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', [ 'only' => ['dashboard', 'profile'] ]);
    }

    /**
     * Show the home
     * @return Response
     */
    public function getIndex()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        return view('landings.home');
    }

    /**
     * Show the backpacking landing
     * @return  Response
     */
    public function getBackpacking()
    {
        return view('landings.backpacking');
    }

    public function getPrivacyTerms()
    {
        return view('landings.privacyTerms');
    }

    public function getAboutUs(Guzzle $guzzle)
    {
        if (LaravelLocalization::getCurrentLocale() == 'es') {
            $res = $guzzle->request('GET', 'https://wp.handytravelers.com/wp-json/wp/v2/pages/4');
        } else {
            $res = $guzzle->request('GET', 'https://wp.handytravelers.com/wp-json/wp/v2/pages/16');
        }

        $page = json_decode($res->getBody());

        return view('landings.about', compact('page'));
    }

    public function getHowItWorks(Guzzle $guzzle)
    {
        if (LaravelLocalization::getCurrentLocale() == 'es') {
            $res = $guzzle->request('GET', 'https://wp.handytravelers.com/wp-json/wp/v2/pages/21');
        } else {
            $res = $guzzle->request('GET', 'https://wp.handytravelers.com/wp-json/wp/v2/pages/23');
        }

        $page = json_decode($res->getBody());

        return view('landings.how-it-works', compact('page'));
    }

    public function geChangeLanguage($lang)
    {
        \Session::put('locale', $lang);
        
        return redirect('/');
    }

    public function blog(Guzzle $guzzle)
    {
        return Redirect::to('https://nomadasdigitales.com/blog', 301); 

        if (LaravelLocalization::getCurrentLocale() == 'es') {
            $res = $guzzle->request('GET', 'https://wp.handytravelers.com/wp-json/wp/v2/posts?tags=2');
        } else {
            $res = $guzzle->request('GET', 'https://wp.handytravelers.com/wp-json/wp/v2/posts?tags=3');
        }

        $posts = json_decode($res->getBody());

        return view('landings.blog', compact('posts'));
    }


    public function blogPost(Guzzle $guzzle, $slug)
    {
        return Redirect::to('https://nomadasdigitales.com/'.$slug, 301); 

        $tag = (LaravelLocalization::getCurrentLocale() == 'es') ? 2 : 3;

        $res = $guzzle->request('GET', "https://wp.handytravelers.com/wp-json/wp/v2/posts?slug=$slug&tags=$tag");
        $post = json_decode($res->getBody())[0];

        $profile = User::getByWordpressId($post->author);

        return view('blog.post', compact('post', 'profile'));
    }



    public function profile($username)
    {
        try {
            $profile = User::where('username', $username)->with('home.place', 'from', 'languages')->firstOrFail();
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'That user is not longer active.');
        }

        $images = (new Images)->getUrls('300', $profile->id);
        $users = User::where('home_id', $profile->home->id)->get();

        return view('landings.profile', compact('profile', 'users', 'images', 'languages', 'home'));
    }


    public function dashboard()
    {
        $user = Auth::user();

        $home = $user->home;
        $requests = null;
        
        if ($home->place_id) {
            $places = Place::getPlacesAround($home->place_id)->pluck('id');

            $requests = r::whereIn('place_id', $places)
            ->where('check_in', '>=', Carbon::now()->startOfDay())
            ->with('user.images')->whereDoesntHave('invitations', function ($query) use ($user) {
                $query->where('sent_by', '=', $user->id);
            })->where('active', 1)->get();
        }

        $myRequests = r::where([
            ['user_id', '=', $user->id],
            ['check_in', '>=', Carbon::now()->startOfDay()],
            ['active', 1]
        ])->get();

        return view('landings.dashboard', compact('user', 'home', 'housemateRequests', 'requests', 'myRequests'));
    }
}
