<?php 

namespace Handytravelers\Http\Controllers;

use Handytravelers\Components\Requests\Models\Participant;
use Handytravelers\Components\Requests\Models\Request as HomeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InboxController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function show()
    {
        $user = Auth::user();

        $requests = $user->requests()->with('participants.user')->latest('updated_at')->get();

        $participantInRequests = Participant::where('user_id', $user->id)->get();

        $requests = HomeRequest::whereIn('id', $participantInRequests->pluck('request_id'))
        ->with('participants.user')
        ->latest('updated_at')->get();

        return view('request.inbox', compact('requests'));
    }

}
