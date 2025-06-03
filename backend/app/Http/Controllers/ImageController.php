<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Image::latest()->get()->map(function ($image) {
            return [
                'id' => $image->id,
                'user_id'=>$image->user_id,
                'label' => $image->label,
                'url' => url(Storage::url($image->path)),
                
            ];
          
        });
    }

  

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => ['required','string','max:255'],
            'path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $userId = Auth::user()->id;
       $path=  $request->file('path')->store('images' , 'public');
       $image = Image::create([
            'label' => $request->label,
            'path' => $path,
            'user_id' => $userId,
        ]);
        return response($image, 201);
    }

   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        $userId = Auth::user()->id;
       
        if( $userId === $image->user_id){
            
            $image->delete();
            Storage::delete($image->path);
        }else{
            
            return response('Unauthorized', 401);
        }
       
        return response(null, 204);
    }
}
