<?php 

namespace Handytravelers\Http\Controllers;

use Handytravelers\Components\Requests\Models\Request as r;
use Handytravelers\Components\Images\Images;
use Handytravelers\Components\Images\Models\Image;
use Handytravelers\Components\Places\Places;
use Handytravelers\Components\Users\Models\Language;
use Handytravelers\Components\Users\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SKAgarwal\GoogleApi\Exceptions\GooglePlacesApiException;
use Handytravelers\Components\Homes\Home;
use Illuminate\Validation\Rule;


class EditController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getPhotos(Image $image, Images $images)
    {
        $user = Auth::user();

        $images = $images->getUrls('300');

        return view('edit.photos', ['new' => 1, 'user' => $user, 'images' => $images]);
    }

    public function getProfile()
    {
        $user = Auth::user();
        $home = $user->home;

        $user->placeName = Places::getPlaceFullName($user->from);
        $home->placeName = Places::getPlaceFullName($home->place);

        if (!$user->isFilled()) {
            return view('wizard.profile', ['user' => $user, 'languages' => Language::all(), 'home' => $home ]);
        }

        return view('edit.profile', ['user' => $user, 'languages' => Language::getAllLanguages($user), 'home' => $home ]);
    }
   

    public function postProfile(Request $request)
    {
        $user = Auth::user();

        if ($request->has('first_name')) {
            $user->first_name = $request->input('first_name');
        }

        if ($request->has('last_name')) {
            $user->last_name = $request->input('last_name');
        }
        

        if ($request->has('gender')) {
            $user->gender = $request->input('gender');
        }

        if ($request->has('date_of_birth')) {
            $user->date_of_birth = $request->input('date_of_birth');
        }

        if ($request->has('from')) {
            try {
                $places = Places::setPlace($request->input('from'));

                $user->place_id = $places['city'];

                $home = $user->home;

                if (!$home->place_id) {
                    $home->place_id = $places['city'];

                    $home->save();
                }
            } catch (GooglePlacesApiException $e) {
                $request->session()->flash('error', 'We couldn\'t find that place using the Google Maps. We\'re really sorry.');
            }
        }

        if ($request->has('live')) {
            try {
                $places = Places::setPlace($request->input('live'));

                $home = $user->home;
                $home->place_id = $places['city'];
                $home->save();
            } catch (GooglePlacesApiException $e) {
                $request->session()->flash('error', 'We couldn\'t find that place using the Google Maps. We\'re really sorry.');
            }
        }

        if ($request->has('about')) {
            $user->about = $request->input('about');
        }

        if ($request->has('languages')) {
            $user->languages()->sync(array_keys($request->only('languages')['languages']));
        }


        $user->save();

        if ($request->has('wizard')) {
            return redirect()->route('edit.completed');
        }

        return redirect()->route('edit.profile');
    }

    public function getPayment()
    {
        $user = Auth::user();

        return view('edit.payment', compact('user') );
    }

    public function postPayment()
    {

        $user = $request->user();

        $this->validate($request, [
            'stripeToken' => 'required'
        ]);

        $homeRequest = new HomeRequest($user);

        $homeRequest->activate(
            $homeRequest->getRequest($request->input('requestId')),
            $request->input('stripeToken')
        );

        return redirect()->route('request.send');

        return view('edit.payment', compact('user') );
    }    

    public function postUpload(Request $request, Images $image)
    {
        $this->validate($request, [
            'files' => 'required',
        ]);

        $image = $image->newPhoto($request->image,Auth::user()->id);

        return ['id' => $image->id, 'url' => Images::getUrl('300',$image->url), 'main' => $image->main];
    }

    /**
     * @param Request $request
     * @param Filesystem $filesystem
     */
    public function deletePhotos(Request $request, Images $image)
    {
        if($request->ajax())
        {
            $image->delete($request->input('id'));
        }
    }

    //name??
    public function editPhotos(Request $request, Images $image)
    {
        $image->setMain($request->input('id'));
    }


    public function getHome()
    {
        $user = Auth::user();

        $user->home->placeName = Places::getPlaceFullName($user->home->place);

        if (!$user->home->isFilled()) {
            return view('wizard.home', ['home' => $user->home]);
        }

        return view('edit.home', ['home' => $user->home, 'user' => $user]);
    }

    public function postHome(Request $request)
    {
        $this->validate($request, [
            'summary' => 'required',
        ]);

        $home = Auth::user()->home;

        $home->update($request->only([
            'summary',
            'rules',
            'gender',
            'interaction',
            'accommodation',
            'getting_around',
            'other'
        ]));
        
        // $home->update($request->intersect([
        //     'summary',
        //     'rules',
        //     'gender',
        //     'interaction',
        //     'accommodation',
        //     'getting_around',
        //     'other'
        // ]));

        // if ($request->has('wizard')) {
        //     return redirect()->route('edit.housemates');
        // }

        return redirect()->route('edit.home');
    }

    public function getHousemates()
    {
        $user = Auth::user();
        $home = $user->home;

        if ($home->type == 'male' || $home->type == 'female') {
            $home->type = 'single';
        }

        $housemates = User::where([
            ['home_id', '=', $home->id],
            ['id', '!=', $user->id]
        ])->get();


        if (!$home->type) {
            return view('wizard.housemates', ['wizard' => 1,'user' => $user, 'home' => $home, 'housemates' => $housemates ]);
        }

        return view('edit.housemates', ['user' => $user, 'home' => $home, 'housemates' => $housemates]);
    }

    public function postHousemates(Request $request)
    {
        $this->validate($request, [
            'type' => [
                'required',
                Rule::in(['single', 'family', 'couple', 'group']),
            ],
        ]);

        $user = Auth::user();
        $home = $user->home;
        $home->type = $request->input('type');

        if ($request->input('type') == 'single') {
            $home->type = $user->gender;
        } else {
            $home->type = $request->input('type');
        }

        $home->save();
    }

    public function completed()
    {
        return view('wizard.completed');
    }

}
