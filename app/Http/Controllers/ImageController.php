<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Publication;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function primary($publication, $id) {
        if(!auth()->user()->hasRole('publisher'))
            return back()->with('status', 'You are not allowed to perform this action!');

        $image = Image::where('id', $id)->where('publication_id', $publication)->first();

        if(is_null($image))
            return back();

        foreach(Publication::find($publication)->images()->get() as $img) {
            $img->update(['is_primary' => 0]);
        }

        if($image->update(['is_primary' => 1])) 
            return back()->with('status', 'Image was set successfully as primary.');

        return back()->with('status', 'Something want wrong while setting primary image!');
    }

    public function delete($publication, $id) {
        if(!auth()->user()->hasRole('publisher'))
            return back()->with('status', 'You are not allowed to perform this action!');

        $image = Image::where('id', $id)->where('publication_id', $publication)->first();

        if(is_null($image))
            return back();

        if($image->delete()) 
            return back()->with('status', 'Image was deleted successfully.');

        return back()->with('status', 'Something want wrong while deleting selected image!');
    }
}
