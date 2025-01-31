<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Services;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Services::select('id', 'title', 'description', 'price', 'image', 'isAvailable')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return response()
        ->view('admin.services', compact('services'))
        ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');
    }

    public function store(StoreServiceRequest $request)
    {
        if ($request->hasFile('picture')) {
            $fileNameWithExtension = $request->file('picture')->getClientOriginalName();
            
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            
            $extension = $request->file('picture')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            
            $path = $request->file('picture')->storeAs('public/services_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        
        $services = new Services();
        
        $services->title = $request->service_name;
        $services->description = $request->description;
        $services->price = $request->pricing;
        $services->image = $fileNameToStore;
        
        $services->save();
        
        return redirect()->route('admin.services')->with('success', 'Service added successfully!');
    }

    public function update(Request $request)
    {
        $service = Services::findOrFail($request->id);
    
        $service->title = $request->service_name;
        $service->description = $request->description;
        $service->price = $request->pricing;
        $service->isAvailable = $request->status;
    
        if ($request->hasFile('picture')) {
            $fileNameWithExtension = $request->file('picture')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('picture')->storeAs('public/services_images', $fileNameToStore);
    
            if (!empty($service->image)) {
                Storage::disk('public')->delete('services_images/' . $service->image);
            }

            $service->image = $fileNameToStore;
        }
    
        $service->save();
    
        return redirect()->back()->with('success', 'Service updated successfully!');
    }
    

    public function delete($id)
    {
        $services = Services::findOrFail($id);
    
        Storage::delete('public/services_images/' . $services->image);
    
        $services->delete();
    
        return redirect()->route('admin.services')->with('success', 'Service deleted successfully!');
    }

    public function getServiceDetails(Request $request)
    {
        $serviceId = $request->input('id');

        try {
            $service = Services::findOrFail($serviceId);

            return response()->json($service);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Service not found.'], 404);
        }
    }

    public function showById(Request $request)
    {
        $serviceId = $request->input('service_id');
        $service = Services::find($serviceId);

        if (!$service) {
            // Handle product not found
            return response()->json(['error' => 'Service not found'], 404);
        }

        // Render the view with product details
        $view = view('marketplace.show_service', compact('service'))->render();

        return response()->json(['view' => $view]);
    }
}
