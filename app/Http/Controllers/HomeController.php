<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request) {
        $publications = Publication::where('status', 1)->paginate(20);

        if( isset($request->q) && !empty($request->q) ) {
            $publications = Publication::where('title', 'like', '%'.$request->q.'%')->paginate(20);
        }

        return view('home', [
            'publications' => $publications
        ]);
    }

    public function show($slug) {
        $publication = Publication::where('slug', $slug)->first();
        
        if(is_null($publication)) 
            return redirect()->route('home');

        $publication->total_views = $publication->total_views + 1;
        $publication->save();

        return view('publications.show', [
            'publication' => $publication
        ]);
    }
}
