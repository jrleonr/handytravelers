<?php 

namespace Handytravelers\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Perfom a search query against the homes availabe
     * @param string $query
     * @return mixed
     */
    public function show(Request $request)
    {
        $query = $request->get('q');

        return view('search.show', compact('query'));
    }

}
