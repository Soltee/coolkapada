<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Media;

class MediaController extends Controller
{
    public function index()
    {
        $medias = Media::latest()->paginate(8);
        // dd(Media::pluck('id')->toArray());

        return view('admin.medias.index', compact('medias'));
    }
    
    /**
     * Store Media
     */
    public function store(Request $request)
    {
        $request->validate([
          'files.*' => 'mimes:jpeg,jpg,png|max:2048'
        ]);

        if($request->hasFile('files')){

            $images      = $request->file('files'); 
        
            foreach ($images as $image) {
                $original  = 'md-' . 
                                Str::random() . '.' . $image->getClientOriginalExtension();

                $image->move(storage_path('app/public/products'), $original);
        
                $path = 'storage/products/' . $original;
                Media::create([
                        'image_url'  => $path,
                        'thumbnail'  => $original
                    ]);
            }

            return back()
                ->with('toast_success', 'Media uploaded.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        if(File::exists($media->image_url)){
            unlink($media->image_url);
        }
        
        $media->delete();

        return redirect()->route('medias')
                        ->with('toast_success', 'Media deleted.');
    }

}
