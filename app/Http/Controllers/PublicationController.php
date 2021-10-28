<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->hasRole(['publisher', 'admin'])) {
            return redirect()->route('dashboard')->with('You are not allowed to perform this action!');
        }

        if(auth()->user()->hasRole('publisher')) {
            $publications = Publication::where('user_id', auth()->id())->get();
        }

        if(auth()->user()->hasRole('admin')) {
            $publications = Publication::all();
        }

        return view('shared.publications.index', [
            'publications' => $publications
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user()->hasRole('publisher')) {
            return redirect()->route('dashboard')->with('You are not allowed to perform this action!');
        }

        return view('shared.publications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!auth()->user()->hasRole('publisher')) {
            return redirect()->route('dashboard')->with('You are not allowed to perform this action!');
        }

        $request->validate([
            'title' => 'required|min:20',
            'phone' => 'required',
            'email' => 'required|email',
            'price' => 'required',
            'description' => 'required',
            // 'images' => 'required'
        ]);

        $publication = [
            'title' => $request->title,
            'phone' => $request->phone,
            'email' => $request->email,
            'price' => $request->price,
            'description' => $request->description,
            'slug' => $this->generateSlug($request->title),
            'user_id' => auth()->id()
        ];

        if($p = Publication::create($publication)) {
            if($request->hasFile('images')) {
                $images = '';
                foreach($request->images as $image) {
                    $extension = $image->extension();
                    $filename = time() ."_" .str_shuffle("1234567890").".".$extension;
                
                    $image->move(public_path('publication_images'), $filename);
                    //Storage::put('public/publications/'.$image->getClientOriginalName(), $image, 'public');

                    // model Image
                    Image::create(['name' => $filename, 'publication_id' => $p->id]);
                }
            }

            return redirect()->route('dashboard.publications.index')->with('status', 'Publication status was created successfully.');
        }

        return back()->with('status', 'Something want wrong while creating the publication!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!auth()->user()->hasRole('publisher')) {
            return redirect()->route('dashboard')->with('You are not allowed to perform this action!');
        }

        $publication = Publication::findOrFail($id);

        return view('shared.publications.edit', [
            'publication' => $publication
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!auth()->user()->hasRole('publisher')) {
            return redirect()->route('dashboard')->with('You are not allowed to perform this action!');
        }

        $request->validate([
            'title' => 'required|min:20',
            'phone' => 'required',
            'email' => 'required|email',
            'price' => 'required',
            'description' => 'required',
            // 'images' => 'required'
        ]);

        $p = Publication::findOrFail($id);

        $publication = [
            'title' => $request->title,
            'phone' => $request->phone,
            'email' => $request->email,
            'price' => $request->price,
            'description' => $request->description,
            'slug' => $this->generateSlug($request->title),
            'user_id' => auth()->id(),
            'status' => 0
        ];

        if($p->update($publication)) {
            if($request->hasFile('images')) {
                $images = '';
                foreach($request->images as $image) {
                    $extension = $image->extension();
                    $filename = time() ."_" .str_shuffle("1234567890").".".$extension;
                
                    $image->move(public_path('publication_images'), $filename);
                    //Storage::put('public/publications/'.$image->getClientOriginalName(), $image, 'public');

                    // model Image
                    Image::create(['name' => $filename, 'publication_id' => $p->id]);
                }
            }

            return redirect()->route('dashboard.publications.index')->with('status', 'Publication status was updated successfully.');
        }

        return back()->with('status', 'Something want wrong while updating the publication!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!auth()->user()->hasRole('publisher'))
            return back()->with('status', 'You are not allowed to perform this action!');

        $publication = Publication::findOrFail($id);
        $publication->images()->delete();

        if($publication->delete()) 
            return redirect()->route('dashboard.users.index')->with('status', 'Publication was deleted successfully.');

        return back()->with('status', 'Something want wrong while deleting selected publication!');
    }
    
    public function toggleStatus($id) {
        if(!auth()->user()->hasRole('admin'))
            return back()->with('status', 'You are not allowed to perform this action!');
        
        if(!auth()->user()->hasPermissionTo('update publications'))
            return back()->with('status', 'You are not allowed to perform this action!');

        $publication = Publication::findOrFail($id);
        $publication->status = ($publication->status == 0) ? 1 : 0;

        if($publication->save())  
            return redirect()->route('dashboard.publications.index')->with('status', 'Publication status was updated successfully.');

        return back()->with('status', 'Something want wrong while toggling the status!');
    }

    public function generateSlug($title) {
        return implode("-", explode(" ", strtolower($title)));
    }
}
