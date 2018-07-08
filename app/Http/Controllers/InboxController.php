<?php 

namespace Handytravelers\Http\Controllers;

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

        //$requests = $user->requests()->with('participants.user')->latest('updated_at')->get();

        $requests = $user->requests()->latest('updated_at')->get();


        return view('request.inbox', compact('requests'));
    }

}
