<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAboutUsRequest;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $abouts = AboutUs::select('id', 'title', 'header', 'body', 'footer', 'image')
                    ->orderBy('created_at', 'desc')
                    ->get();
                    
        return response()
            ->view('admin.admin-about-us', compact('abouts'))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function store(StoreAboutUsRequest $request)
    {
        if ($request->hasFile('picture')) {
            $fileNameWithExtension = $request->file('picture')->getClientOriginalName();
            
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            
            $extension = $request->file('picture')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            
            $path = $request->file('picture')->storeAs('public/about_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        
        $about = new AboutUs();
        
        $about->title = $request->title;
        $about->header = $request->header;
        $about->body = $request->body;
        $about->footer = $request->footer;
        $about->image = $fileNameToStore;
        
        $about->save();
        
        return redirect()->back()->with('success', 'About Us added successfully!');
    }

    public function update(Request $request)
    {
        $about = AboutUs::findOrFail($request->id);
    
        $about->title = $request->title;
        $about->header = $request->header;
        $about->body = $request->body;
        $about->footer = $request->footer;
    
        if ($request->hasFile('picture')) {
            $fileNameWithExtension = $request->file('picture')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('picture')->storeAs('public/about_images', $fileNameToStore);
    
            if (!empty($about->image)) {
                Storage::disk('public')->delete('about_images/' . $about->image);
            }

            $about->image = $fileNameToStore;
        }
    
        $about->save();
    
        return redirect()->back()->with('success', 'About Us updated successfully!');
    }

    public function delete($id)
    {
        $product = AboutUs::findOrFail($id);
    
        Storage::delete('public/about_images/' . $product->image);
    
        $product->delete();
    
        return redirect()->back()->with('success', 'About Us deleted successfully!');
    }

    public function getAboutDetails(Request $request)
    {
        $about_id = $request->input('id');

        try {
            $about = AboutUs::findOrFail($about_id);

            return response()->json($about);
        } catch (\Exception $e) {
            return response()->json(['error' => 'About Us not found.'], 404);
        }
    }
}
